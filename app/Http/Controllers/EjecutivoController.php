<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
       // $productos = DB::table('productos')->distinct()->get('familia');
        $productos = Producto::distinct()->get('familia');
        return view('inventario.visualizar_inventario',compact('productos'));
    }

    //Redireccionamiento al portal de los precios de los productos del sistema.
    public function index_precios()
    {
        $productos_en_bruto = DB::table('productos')->get();
        $productos_en_stock = DB::table('localizacions')->get();
        return view('inventario.portal_precios',compact('productos_en_bruto','productos_en_stock'));
    }


    //Método responsivo para realizar dropdowns dinámicos en la selección de producto en el inventario.
    public function familias(Request $request){
        
        if(isset($request->texto)){
            $familias = Producto::where('Familia',$request->texto)->get();
            return response()->json(
                [
                    'lista' => $familias,
                    'success' => true
                ]
                );
        }else{
            return response()->json(
                [
                    'success' => false
                ]
                );

        }

    }

    public function detalle_producto(Request $request)
    {
        if($request->action != null){//para verificar desde donde se llama a este metodo, se verifica el contenido de action de la request, si action tiene un valor es porque la request viene desde la vista inicial, si action es null es porque la request viene de detalle de producto luego de cambiar el stock
            $familia = $request->input('_producto');
            $id_producto = $request->input('_familia');//es el id del producto en la tabla productos
            $tipo_submit = $request->input('action');
            $producto_en_stock = DB::table('localizacions')->where('producto_id',$id_producto)->first(); 
            $producto_en_bruto = DB::table('productos')->where('id',$id_producto)->first();
            $familia = EjecutivoController::detectar_nombre($producto_en_bruto->familia);
            $producto_en_tabla = DB::table($familia)->where('producto_id',$id_producto)->first();
            if($tipo_submit=="detalle"){  
                return view('inventario.detalle_producto',compact('producto_en_stock','producto_en_bruto','producto_en_tabla'));
            }else{
                //Futuro redirect a formulario del René
                if($tipo_submit == "realizar_venta"){
                    //return view('inventario.realizar_venta_ejecutivo',compact('producto_en_stock','producto_en_bruto','producto_en_tabla'));
                }else{

                }
            }
        }
        else{
            $var=$request->producto_en_stock_redirect;
            $id_producto_redirect=$var['producto_id'];
            
            $producto_en_stock = DB::table('localizacions')->where('producto_id',$id_producto_redirect)->first(); 
            $producto_en_bruto = DB::table('productos')->where('id',$id_producto_redirect)->first();
            $nombre = $producto_en_bruto->familia;
            $familia = EjecutivoController::detectar_nombre($nombre);
            $producto_en_tabla = DB::table($familia)->where('producto_id',$id_producto_redirect)->first();
            return view('inventario.detalle_producto',compact('producto_en_stock','producto_en_bruto','producto_en_tabla'));

        }
        
        
    }

    public function detalle_producto_stock_actualizado(Request $request,$id)
    {
        $request->validate([
            'stock' => ['required','integer'],
        ]);
        $update = DB::table('localizacions')->where('producto_id',$id)->update(['stock'=>$request->stock]);
        $producto_en_stock = DB::table('localizacions')->where('producto_id',$id)->first();
        $producto_en_bruto = DB::table('productos')->where('id',$id)->first();
        return redirect()->route('ver_detalle',['producto_en_stock_redirect'=>$producto_en_stock,'producto_en_bruto_redirect'=>$producto_en_bruto])->with('correcto_stock','Stock actualizado correctamente');
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

        return redirect()->route('ver_detalle',['producto_en_stock_redirect'=>$producto_en_stock,'producto_en_bruto_redirect'=>$producto_en_bruto])->with('correcto_producto','Producto actualizado correctamente');

    }

    public function borrar_producto($id)
    {
        $producto_a_eliminar = Producto::find($id);
        $producto_a_eliminar->delete();
        return redirect()->route('ver_inventario')->with('correcto_eliminado','Has eliminado el producto correctamente');
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
