<?php

namespace App\Http\Controllers;

use App\Models\Clavo;
use App\Models\Imagen;
use App\Models\Madera;
use App\Models\Mueble;
use App\Models\Producto;
use App\Models\Tornillo;
use App\Models\Techumbre;
use App\Models\Localizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Plancha_construccion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EjecutivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Redirecionamiento al portal del inventario, en donde se acarrean todos los productos para utilizar.
    public function index()
    {
        $usuario_logeado = DB::table('users')->join('trabajadors','users.rut','=','trabajadors.usuario_rut')->where('rut',Auth::user()->rut)->first();
        $productos = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('sucursal_id',$usuario_logeado->sucursal_id)->get();
        return view('inventario.control_inv',compact('productos'));
    }
    //Redireccionamiento al portal de los precios de los productos del sistema.
    public function index_precios()
    {
        $datos=DB::table('productos')->get();
        return view('ventas.visualizar_producto',compact('datos'));
    }

    public function cargar_administrar(Request $request)//entrega el id para cargar la pagina para administrar un producto
    {   
        $id_producto_str = $request->id_producto_hidden;
        $id_producto_int = intval($id_producto_str);

        return redirect()->route('ver_detalle',['id_redirect'=>$id_producto_int]);
        
    }

    //con el id de producto se puede detectar todo lo que se necesita:familia,productos, localizacions
    public function detalle_producto($id_redirect)
    {   
        if($id_redirect == 0 || $id_redirect == null)
        {
            return redirect()->route('ver_inventario')->with('no_product_selected','Ha ocurrido un error. Ha ingresado un producto inválido.');
        }

        $id_producto_redirect=$id_redirect;
        $producto_en_stock = DB::table('localizacions')->where('producto_id',$id_producto_redirect)->first(); 
        $producto_en_bruto = DB::table('productos')->where('id',$id_producto_redirect)->first();
        $imagenes = DB::table('imagens')->where('imagenable_id',$producto_en_bruto->id)->get();
        $contador_aux = DB::table('imagens')->where('imagenable_id',$producto_en_bruto->id)->count();
        
        return view('inventario.administrar_prod',compact('producto_en_stock','producto_en_bruto','imagenes','contador_aux'));

    }
    

    public function detalle_producto_stock_actualizado(Request $request,$id)
    {   
        $usuario_logeado = DB::table('users')->join('trabajadors','users.rut','=','trabajadors.usuario_rut')->where('rut',Auth::user()->rut)->first();
        $request->validate([
            'stock' => ['required','integer', 'gt:0'],
        ]);
        DB::table('localizacions')->join('productos','localizacions.producto_id','=','productos.id')->where('producto_id',$id)->where('sucursal_id',$usuario_logeado->sucursal_id)->update(['stock'=>$request->stock]);
        return redirect()->route('ver_detalle',['id_redirect'=>$id])->with('stock_actualizado','Stock actualizado correctamente.');
    }

    public function actualizar_producto(Request $request,$id)
    {   
        $request->validate([
            'nombre' => ['required','max:255'],
            'descripcion' => ['required','max:255'],
        ]);

        $producto_en_bruto = DB::table('productos')->where('id',$id)->first();
        if($producto_en_bruto->familia == "Madera")
        {            
            $request->validate([
                'alto' => ['required','integer', 'gt:0'],
                'largo' => ['required','numeric', 'gt:0'],
                'ancho' => ['required','integer', 'gt:0'],
                'tipo_madera' => ['required'],
                'tratamiento' => ['required'],
            ]);
            DB::table('maderas')->where('producto_id',$id)
            ->update(['alto'=>$request->alto,
            'ancho' => $request->ancho,
            'largo' => $request->largo,
            'tipo_madera' => $request->tipo_madera,
            'tratamiento' => $request->tratamiento]);
        }

        if($producto_en_bruto->familia == "Clavo")
        {
            $request->validate([
                'cabeza' => ['required','numeric', 'gt:0'],
                'longitud' => ['required','numeric', 'gt:0'],
                'material' => ['required'],
                'punta' => ['required'],
            ]);
            DB::table('clavos')->where('producto_id',$id)
            ->update(['material'=>$request->material,
            'cabeza' => $request->cabeza,
            'punta' => $request->punta,
            'longitud' => $request->longitud]);
        }

        if($producto_en_bruto->familia == 'Techumbre')
        {
            $request->validate([
                'alto' => ['required','numeric', 'gt:0'],
                'largo' => ['required','numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'material' => ['required'],
            ]);
            DB::table('techumbres')->where('producto_id',$id)
            ->update(['material'=>$request->material,
            'alto' => $request->alto,
            'ancho' => $request->ancho,
            'largo' => $request->largo]);
        }

        if($producto_en_bruto->familia == 'Plancha_construccion')
        {
            $request->validate([
                'alto' => ['required','numeric', 'gt:0'],
                'largo' => ['required','numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'material' => ['required'],
            ]);
            DB::table('plancha_construccions')->where('producto_id',$id)
            ->update(['material'=>$request->material,
            'alto' => $request->alto,
            'ancho' => $request->ancho,
            'largo' => $request->largo]);
        }

        if($producto_en_bruto->familia == 'Tornillo')
        {
            $request->validate([
                'cabeza' => ['required','numeric', 'gt:0'],
                'separacion_rosca' => ['required','numeric', 'gt:0'],
                'rosca_parcial' => ['required','numeric', 'gt:0'],
                'vastago' => ['required','numeric', 'gt:0'],
                'tipo_rosca' => ['required'],
                'punta' => ['required'],
            ]);
            if($request->tipo_rosca == "total")
            {
                DB::table('tornillos')->where('producto_id',$id)
                ->update(['cabeza' => $request->cabeza,
                'tipo_rosca' => 1,
                'separacion_rosca' => $request->separacion_rosca,
                'punta' => $request->punta,
                'rosca_parcial' => $request->rosca_parcial,
                'vastago' => $request->vastago]);
            }
            
            else{

                DB::table('tornillos')->where('producto_id',$id)
                ->update(['cabeza' => $request->cabeza,
                'tipo_rosca' => 2,
                'separacion_rosca' => $request->separacion_rosca,
                'punta' => $request->punta,
                'rosca_parcial' => $request->rosca_parcial,
                'vastago' => $request->vastago]);
            }
        }

        if($producto_en_bruto->familia == "Mueble")
        {
            $request->validate([
                'alto' => ['required','numeric', 'gt:0'],
                'largo' => ['required','numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'material' => ['required'],
                'acabado' => ['required'],
            ]);

            DB::table('muebles')->where('producto_id',$id)
            ->update(['alto'=>$request->alto,
            'largo'=>$request->largo,
            'ancho' => $request->ancho,
            'material' => $request->material,
            'acabado' => $request->acabado]);
        }

        DB::table('productos')->where('id',$id)
        ->update(['nombre'=>$request->nombre,
        'descripcion'=>$request->descripcion,
        'familia' => $request->familia]);
        
        return redirect()->route('ver_detalle',['id_redirect'=>$id])->with('producto_actualizado','Producto actualizado correctamente.');
    }

    public function borrar_producto($id)
    {
        $producto_a_eliminar = Producto::find($id);
        $producto_a_eliminar->delete();
        return redirect()->route('ver_inventario')->with('correcto_eliminado','Has eliminado el producto correctamente');
    }

    public function actualizar_precio_producto(Request $request,$id)
    {
        $usuario_logeado = DB::table('users')->join('trabajadors','users.rut','=','trabajadors.usuario_rut')->where('rut',Auth::user()->rut)->first();
        $request->validate([
            'utilidad' => ['required','integer', 'gt:0'],
        ]);
        DB::table('localizacions')->join('productos','localizacions.producto_id','=','productos.id')->where('sucursal_id',$usuario_logeado->sucursal_id)->where('producto_id',$id)->update(['precio_venta'=>$request->precio_venta]);        
        return redirect()->route('ver_detalle',['id_redirect'=>$id])->with('precio_actualizado','Precio de venta del producto actualizado correctamente');
    }

    public function agregar_producto(Request $request)
    {
        $request->validate([
            'nombre' => ['required','max:255'],
            'descripcion' => ['required','max:255'],
            'familia' => ['required','max:29'],
            'stock' => ['required','integer', 'gt:0'],
            'precio_compra' => ['required','integer', 'gt:0'],
        ]);
        $familia = EjecutivoController::detectar_nombre($request->familia);

        if($familia == "maderas")
        {
            $request->validate([
                'alto' => ['required','integer', 'gt:0'],
                'largo' => ['required','numeric', 'gt:0'],
                'ancho' => ['required','integer', 'gt:0'],
                'tipo_madera' => ['required'],
                'tratamiento' => ['required'],
                'stock' => ['required','integer', 'gt:0'],
                'precio_compra' => ['required','integer', 'gt:0'],
            ]);
            $producto_nuevo = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'nivel_demanda' => 1,
                'familia' => $request->familia,
            ]);
            Madera::create([
                'producto_id' => $producto_nuevo->id,
                'alto' => $request->alto,
                'ancho' => $request->ancho,
                'largo' => $request->largo,
                'tipo_madera' => $request->tipo_madera,
                'tratamiento' => $request->tratamiento,
            ]);
        }

        elseif($familia == "clavos")
        {
            $request->validate([
                'cabeza' => ['required','numeric', 'gt:0'],
                'longitud' => ['required','numeric', 'gt:0'],
                'material' => ['required'],
                'punta' => ['required'],
                'stock' => ['required','integer', 'gt:0'],
                'precio_compra' => ['required','integer', 'gt:0'],
            ]);
            $producto_nuevo = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'nivel_demanda' => 1,
                'familia' => $request->familia,
            ]);
            Clavo::create([
                'producto_id' => $producto_nuevo->id,
                'material' => $request->material,
                'cabeza' => $request->cabeza,
                'punta' => $request->punta,
                'longitud' => $request->longitud,
            ]);
        }

        elseif($familia == "techumbres")
        {
            
            $request->validate([
                'alto' => ['required','numeric', 'gt:0'],
                'largo' => ['required','numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'material' => ['required'],
                'stock' => ['required','integer', 'gt:0'],
                'precio_compra' => ['required','integer', 'gt:0'],
            ]);
            $producto_nuevo = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'nivel_demanda' => 1,
                'familia' => $request->familia,
            ]);
            Techumbre::create([
                'producto_id' => $producto_nuevo->id,
                'material' => $request->material,
                'alto' => $request->alto,
                'ancho' => $request->ancho,
                'largo' => $request->largo,
            ]);
        }

        elseif($familia == "plancha_construccions")
        {
            $request->validate([
                'alto' => ['required','numeric', 'gt:0'],
                'largo' => ['required','numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'material' => ['required'],
                'stock' => ['required','integer', 'gt:0'],
                'precio_compra' => ['required','integer', 'gt:0'],
            ]);
            $producto_nuevo = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'nivel_demanda' => 1,
                'familia' => $request->familia,
            ]);
            Plancha_construccion::create([
                'producto_id' => $producto_nuevo->id,
                'material' => $request->material,
                'alto' => $request->alto,
                'ancho' => $request->ancho,
                'largo' => $request->largo,
            ]);
        }

        elseif($familia == "tornillos")
        {
            $request->validate([
                'cabeza' => ['required','numeric', 'gt:0'],
                'separacion_rosca' => ['required','numeric', 'gt:0'],
                'rosca_parcial' => ['required','numeric', 'gte:0'],
                'vastago' => ['required','numeric', 'gt:0'],
                'tipo_rosca' => ['required'],
                'punta' => ['required'],
                'stock' => ['required','integer', 'gt:0'],
                'precio_compra' => ['required','integer', 'gt:0'],
            ]);
            $producto_nuevo = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'nivel_demanda' => 1,
                'familia' => $request->familia,
            ]);
            if($request->tipo_rosca == "total")
            {
                
                Tornillo::create([
                    'producto_id' => $producto_nuevo->id,
                    'cabeza' => $request->cabeza,
                    'tipo_rosca' => 1,
                    'separacion_rosca' => $request->separacion_rosca,
                    'punta' => $request->punta,
                    'rosca_parcial' => $request->rosca_parcial,
                    'vastago' => $request->vastago,
                ]);
            }else{
                Tornillo::create([
                    'producto_id' => $producto_nuevo->id,
                    'cabeza' => $request->cabeza,
                    'tipo_rosca' => 2,
                    'separacion_rosca' => $request->separacion_rosca,
                    'punta' => $request->punta,
                    'rosca_parcial' => $request->rosca_parcial,
                    'vastago' => $request->vastago,
                ]);
            }
        }

        elseif($familia == "muebles")
        {
            $request->validate([
                'alto' => ['required','numeric', 'gt:0'],
                'largo' => ['required','numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'material' => ['required'],
                'acabado' => ['required'],
                'stock' => ['required','integer', 'gt:0'],
                'precio_compra' => ['required','integer', 'gt:0'],
            ]);
            $producto_nuevo = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'nivel_demanda' => 1,
                'familia' => $request->familia,
            ]);
            Mueble::create([
                'producto_id' => $producto_nuevo->id,
                'material' => $request->material,
                'acabado' => $request->acabado,
                'alto' => $request->alto,
                'ancho' => $request->ancho,
                'largo' => $request->largo,
            ]);
        }

        elseif($familia == "herramientas" || $familia == "otros")
        {
            $producto_nuevo = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'nivel_demanda' => 1,
                'familia' => $request->familia,
            ]);
        }

        Localizacion::create([
            'sucursal_id' => 1,
            'producto_id' => $producto_nuevo->id,
            'stock' => $request->stock,
            'precio_compra' =>$request->precio_compra,
        ]);

        return redirect()->route('ver_inventario')->with('correcto_agregado','Has ingresado el nuevo producto correctamente');
    }

    public static function detectar_nombre($nombre)
    {
        $familia = "";
        if($nombre == "Madera"){$familia="maderas";}
        if($nombre == "Clavo"){$familia="clavos";}
        if($nombre == "Techumbre"){$familia="techumbres";}
        if($nombre == "Plancha_construccion"){$familia="plancha_construccions";}
        if($nombre == "Tornillo"){$familia="tornillos";}
        if($nombre == "Mueble"){$familia="muebles";}
        if($nombre == "Herramienta"){$familia="herramientas";}
        if($nombre == "Otro"){$familia="otros";}
        return $familia;
    }

    public function cambiar_estado_producto(Request $request,$id){

        DB::table('productos')->where('id',$id)->update(['estado'=>$request->estado]);

        return redirect()->route('ver_detalle',['id_redirect'=>$id])->with('estado_cambiado','Estado del producto cambiado con éxito.');

    }

    public function historico_ventas(){
        $datos=DB::table('ventas')->get();
        return view('ventas.visualizar_historico',compact('datos'));
    }

    public function ver_detalle_venta($id){
        $datos=DB::table('detalle_ventas')->where('venta_id',$id)->get();
        return view('ventas.visualizar_detalle_historico',compact('datos'));
    }

    public function ver_productos(){

        $productos_en_bruto = DB::table('productos')->get();
        $productos_en_stock = DB::table('localizacions')->get();
        return view('inventario.portal_precios',compact('productos_en_bruto','productos_en_stock'));
    }

    public function subir_imagen(Request $request,$id)
    {
        $request->validate([
            'url' => ['required','image','max:4096'],
            // 'imanegable_tipo' => ['required','string','max:255'],
        ]);
        $auxiliar="\hola";
        $existe_url=Imagen::where('url',"images".$auxiliar[0].$request->file('url')->getClientOriginalName())->first();
        if($existe_url != null){ 
            $request->validate([
                'existe_imagen' => ['integer'],
            ]);
        }

        $guardarImagen=$request->file('url');
        $guardarImagen->move('images', $guardarImagen->getClientOriginalName());
        
        $nuevo_dato = new Imagen();
        $nuevo_dato->url = "images".$auxiliar[0].$guardarImagen->getClientOriginalName();
        $nuevo_dato->imagenable_id = $id;
        $nuevo_dato->imagenable_tipo = 'App\Models\Producto';
        $nuevo_dato->save();
        return redirect()->route('ver_detalle',['id_redirect'=>$id])->with('imagen_subida','Imagen subida con éxito.');

    }

    public function eliminar_imagen(Request $request)
    {
        $id = $request->imagen_id;
        $dato=Imagen::find($id);

        //Borrar la imagen del servidor
        unlink(public_path($dato->url));
        $id_producto = $dato->imagenable_id;
        //Borrar la tupla de la tabla
        $dato->delete();
        return redirect()->route('ver_detalle',['id_redirect'=>$id_producto])->with('imagen_eliminada','Imagen eliminada con éxito.');
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
