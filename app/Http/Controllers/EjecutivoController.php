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
        $productos = DB::table('productos')->get();
        return view('inventario.control_inv',compact('productos'));
    }

    //Redireccionamiento al portal de los precios de los productos del sistema.
    public function index_precios()
    {
        $datos=DB::table('productos')->get();
        return view('ventas.visualizar_producto',compact('datos'));
    }


    //Método responsivo para realizar dropdowns dinámicos en la selección de producto en el inventario.
    // public function familias(Request $request){
        
    //     if(isset($request->texto)){
    //         $familias = Producto::where('Familia',$request->texto)->get();
    //         return response()->json(
    //             [
    //                 'lista' => $familias,
    //                 'success' => true
    //             ]
    //             );
    //     }else{
    //         return response()->json(
    //             [
    //                 'success' => false
    //             ]
    //             );

    //     }

    // }

    //con el id de producto se puede detectar todo lo que se necesita:familia,productos, localizacions
    public function detalle_producto(Request $request)
    {   
        
        $id_producto_str = $request->id_producto_hidden;
        $id_producto_int = intval($id_producto_str);

        if($request->action != null){//para verificar desde donde se llama a este metodo, se verifica el contenido de action de la request, si action tiene un valor es porque la request viene desde la vista inicial, si action es null es porque la request viene de detalle de producto luego de cambiar el stock
            
            //$tipo_submit = $request->input('action');
            $familia = DB::table('productos')->where('id',$id_producto_int)->value('familia');
            $tabla_familia = strtolower($familia.'s');
            $producto_en_stock = DB::table('localizacions')->where('producto_id',$id_producto_int)->first();
            $producto_en_bruto = DB::table('productos')->where('id',$id_producto_int)->first(); 
            $producto_en_tabla = DB::table($tabla_familia)->where('producto_id',$id_producto_int)->first();
                        
            //return view('inventario.detalle_producto',compact('producto_en_stock','producto_en_bruto','producto_en_tabla'));
            return view('inventario.administrar_prod',compact('producto_en_stock','producto_en_bruto','producto_en_tabla'));

        }
        else{
            
            $id_producto_redirect=$request->id_redirect;
            
            $producto_en_stock = DB::table('localizacions')->where('producto_id',$id_producto_redirect)->first(); 
            $producto_en_bruto = DB::table('productos')->where('id',$id_producto_redirect)->first();
            $familia = DB::table('productos')->where('id',$id_producto_redirect)->value('familia');
            $tabla_familia = strtolower($familia.'s');
            $producto_en_tabla = DB::table($tabla_familia)->where('producto_id',$id_producto_redirect)->first();
            //return view('inventario.detalle_producto',compact('producto_en_stock','producto_en_bruto','producto_en_tabla'));
            return view('inventario.administrar_prod',compact('producto_en_stock','producto_en_bruto','producto_en_tabla'));

        }
        
        
    }

    public function detalle_producto_stock_actualizado(Request $request,$id)
    {   
        
        $request->validate([
            'stock' => ['required','integer'],
        ]);
        DB::table('localizacions')->where('producto_id',$id)->update(['stock'=>$request->stock]);
        
        return redirect()->route('ver_detalle',['id_redirect'=>$id])->with('stock_actualizado','Stock actualizado correctamente.');
    }

    public function actualizar_producto(Request $request,$id)
    {
        DB::table('productos')->where('id',$id)
        ->update(['nombre'=>$request->nombre,
        'descripcion'=>$request->descripcion,
        'familia' => $request->familia]);
        
        $producto_en_stock = DB::table('localizacions')->where('producto_id',$id)->first();
        $producto_en_bruto = DB::table('productos')->where('id',$id)->first();
        if($producto_en_bruto->familia == "Madera")
        {
            DB::table('maderas')->where('producto_id',$id)
            ->update(['alto'=>$request->alto,
            'ancho' => $request->ancho,
            'largo' => $request->largo,
            'tipo_madera' => $request->tipo_madera,
            'tratamiento' => $request->tratamiento]);
        }

        if($producto_en_bruto->familia == "Clavo")
        {
            DB::table('clavos')->where('producto_id',$id)
            ->update(['material'=>$request->material,
            'cabeza' => $request->cabeza,
            'punta' => $request->punta,
            'longitud' => $request->longitud]);
        }

        if($producto_en_bruto->familia == 'Techumbre')
        {
            DB::table('techumbres')->where('producto_id',$id)
            ->update(['material'=>$request->material,
            'alto' => $request->alto,
            'ancho' => $request->ancho,
            'largo' => $request->largo]);
        }

        if($producto_en_bruto->familia == 'Plancha_construccion')
        {
            DB::table('plancha_construccions')->where('producto_id',$id)
            ->update(['material'=>$request->material,
            'alto' => $request->alto,
            'ancho' => $request->ancho,
            'largo' => $request->largo]);
        }

        if($producto_en_bruto->familia == 'Tornillo')
        {
            DB::table('tornillos')->where('producto_id',$id)
            ->update(['cabeza' => $request->cabeza,
            'tipo_rosca' => $request->tipo_rosca,
            'separacion_rosca' => $request->separacion_rosca,
            'punta' => $request->punta,
            'rosca_parcial' => $request->rosca_parcial,
            'vastago' => $request->vastago]);
        }

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

        DB::table('localizacions')->where('producto_id',$id)->update(['precio_venta'=>$request->precio_venta]);
        $producto_en_stock = DB::table('localizacions')->where('producto_id',$id)->first();
        $producto_en_bruto = DB::table('productos')->where('id',$id)->first();
        
        return redirect()->route('ver_detalle',['id_redirect'=>$id])->with('precio_actualizado','Precio de venta del producto actualizado correctamente');

    }

    public function agregar_producto(Request $request)
    {
        $producto_nuevo = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'nivel_demanda' => 1,
            'familia' => $request->familia,
        ]);

        $familia = EjecutivoController::detectar_nombre($producto_nuevo->familia);

        if($familia == "maderas")
        {
            Madera::create([
                'producto_id' => $producto_nuevo->id,
                'alto' => $request->alto,
                'ancho' => $request->ancho,
                'largo' => $request->largo,
                'tipo_madera' => $request->tipo_madera,
                'tratamiento' => $request->tratamiento,
            ]);
        }

        if($familia == "clavos")
        {
            Clavo::create([
                'producto_id' => $producto_nuevo->id,
                'material' => $request->material,
                'cabeza' => $request->cabeza,
                'punta' => $request->punta,
                'longitud' => $request->longitud,
            ]);
        }

        if($familia == "techumbres")
        {
            Techumbre::create([
                'producto_id' => $producto_nuevo->id,
                'material' => $request->material,
                'alto' => $request->alto,
                'ancho' => $request->ancho,
                'largo' => $request->largo,
            ]);
        }

        if($familia == "plancha_construccions")
        {
            Plancha_construccion::create([
                'producto_id' => $producto_nuevo->id,
                'material' => $request->material,
                'alto' => $request->alto,
                'ancho' => $request->ancho,
                'largo' => $request->largo,
            ]);
        }

        if($familia == "tornillos")
        {
            Tornillo::create([
                'producto_id' => $producto_nuevo->id,
                'cabeza' => $request->cabeza,
                'tipo_rosca' => $request->tipo_rosca,
                'separacion_rosca' => $request->separacion_rosca,
                'punta' => $request->punta,
                'rosca_parcial' => $request->rosca_parcial,
                'vastago' => $request->vastago,
            ]);
        }

        if($familia == "muebles")
        {
            Mueble::create([
                'producto_id' => $producto_nuevo->id,
                'material' => $request->material,
                'acabado' => $request->acabado,
                'alto' => $request->alto,
                'ancho' => $request->ancho,
                'largo' => $request->largo,
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
        return $familia;
    }

    public function cambiar_estado_producto(Request $request,$id){

        DB::table('productos')->where('id',$id)->update(['estado'=>$request->estado]);

        return redirect()->route('ver_detalle',['id_redirect'=>$id])->with('estado_cambiado','Estado del producto cambiado con éxito.');

    }

    public function historico_ventas(){;
        $datos=DB::table('ventas')->get();
        return view('ventas.visualizar_historico',compact('datos'));
    }

    public function ver_detalle_venta($id){;
        $datos=DB::table('detalle_ventas')->where('venta_id',$id)->get();
        return view('ventas.visualizar_detalle_historico',compact('datos'));
    }

    public function ver_productos(){;

        $productos_en_bruto = DB::table('productos')->get();
        $productos_en_stock = DB::table('localizacions')->get();
        return view('inventario.portal_precios',compact('productos_en_bruto','productos_en_stock'));
    }

    public function subir_imagen(Request $request,$id)
    {
        $request->validate([
            'url' => ['required','image','max:2048'],
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
