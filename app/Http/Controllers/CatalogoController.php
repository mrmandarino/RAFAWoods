<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     //Redireccionamiento a catalogo principal
    public function index()
    {
        $cantidad_productos_pag = 6;
        $productos = DB::table('productos')->paginate($cantidad_productos_pag);
        $imagenes = DB::table('imagens')->get();
        $productos_en_stock = DB::table('localizacions')->get();
        $productos_familia = Producto::distinct()->get('familia');
        $productos_totales = DB::table('productos')->get();
        $familia = "todas";
        return view('catalogo.portal_catalogo',compact('productos','imagenes','cantidad_productos_pag','productos_en_stock','productos_familia','productos_totales','familia'));
    }

    //Redireccionamiento intermedio para filtro por familia
    public function intermedio(Request $request)
    {
        $familia = $request->input_hidden;
        if($familia == "Todos los productos")
        {
            return redirect()->route('ver_catalogo');
        }
        return redirect()->route('ver_catalogo_por_familia',['familia'=>$familia]);
    }

    //Redireccionamiento a catalogo filtrado por familia
    public function index_por_familia($familia)
    {
        $cantidad_productos_pag = 6;
        $productos = DB::table('productos')->where('familia', $familia)->paginate($cantidad_productos_pag);
        $imagenes = DB::table('imagens')->get();
        $productos_en_stock = DB::table('localizacions')->get();
        $productos_familia = Producto::distinct()->get('familia');
        $productos_totales = DB::table('productos')->get();
        return view('catalogo.catalogo_por_familia', compact('productos','imagenes','cantidad_productos_pag','productos_en_stock','productos_familia','productos_totales','familia'));
    }

    //Redireccionamiento intermedio para detalle de producto
    public function intermedio_producto(Request $request)
    {
        $nombre_producto = $request->input_hidden_producto;
        return redirect()->route('ver_detalle_producto',['nombre_producto'=>$nombre_producto]);
    }

    //Redireccionamiento para vista de detalle de producto
    public function detalle_producto($nombre_producto)
    {
        //productos para datalists de búsqueda
        $cantidad_productos_pag = 6;
        $productos = DB::table('productos')->paginate($cantidad_productos_pag);
        $imagenes = DB::table('imagens')->get();
        $productos_en_stock = DB::table('localizacions')->get();
        $productos_familia = Producto::distinct()->get('familia');
        $productos_totales = DB::table('productos')->get();

        //Producto en particular
        $producto = DB::table('productos')->where('nombre',$nombre_producto)->first();
        $familia = $producto->familia;
        $familia_fixed = EjecutivoController::detectar_nombre($familia);
        $producto_en_stock = DB::table('localizacions')->where('producto_id',$producto->id)->first();
        $producto_en_tabla = DB::table($familia_fixed)->where('producto_id',$producto->id)->first();
        return view('catalogo.detalle_producto',['producto'=>$producto,'producto_en_tabla'=>$producto_en_tabla,'producto_en_stock'=>$producto_en_stock,'imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_en_stock'=>$productos_en_stock,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales]);
    }

    //Redireccionamiento intermedio para catalogo filtrado
    public function intermedio_filtro($familia,$tipo_filtro)
    {
        return redirect()->route('ver_catalogo_filtrado',['tipo_filtro'=>$tipo_filtro,'familia'=>$familia]);
    }

    //Redireccionamiento a vista con productos filtrados según lo que se indique
    public function index_filtro($tipo_filtro,$familia)
    {
        $cantidad_productos_pag = 6;
        $imagenes = DB::table('imagens')->get();
        $productos_en_stock = DB::table('localizacions')->get();
        $productos_familia = Producto::distinct()->get('familia');
        $productos_totales = DB::table('productos')->get();
        $productos_filtrados = null;
        
        //Filtras para todo tipo de producto
        if($familia == "todas"){

            //Filtrar alfabeticamente
            if($tipo_filtro == "asc_alfb")
            {
                $productos_filtrados = DB::table('productos')->orderBy('nombre')->paginate($cantidad_productos_pag);
                return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_en_stock'=>$productos_en_stock,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
            }else{
                if($tipo_filtro == "des_alfb")
                {
                    $productos_filtrados = DB::table('productos')->orderBy('nombre','desc')->paginate($cantidad_productos_pag);
                    return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_en_stock'=>$productos_en_stock,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
                }else{

                    //Filtrar por precio
                    if($tipo_filtro == "asc_precio"){
                        $productos_filtrados = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->orderBy('precio_venta')->paginate($cantidad_productos_pag);
                        return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_en_stock'=>$productos_en_stock,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
                    }else{
                        if($tipo_filtro == "des_precio")
                        {
                            $productos_filtrados = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->orderBy('precio_venta','desc')->paginate($cantidad_productos_pag);
                            return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_en_stock'=>$productos_en_stock,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
                        }
                    }
                }
            }

            
        }
        
        //Filtrar para un tipo de familia en particular
        else{

            //Filtrar alfabeticamente
            if($tipo_filtro == "asc_alfb")
            {
                $productos_filtrados = DB::table('productos')->where('familia',$familia)->orderBy('nombre')->paginate($cantidad_productos_pag);
                return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_en_stock'=>$productos_en_stock,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
            }else{
                if($tipo_filtro == "des_alfb")
                {
                    $productos_filtrados = DB::table('productos')->where('familia',$familia)->orderBy('nombre','desc')->paginate($cantidad_productos_pag);
                    return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_en_stock'=>$productos_en_stock,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
                }else{

                    //Filtrar por precio
                    if($tipo_filtro == "asc_precio"){
                        $productos_filtrados = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('familia',$familia)->orderBy('precio_venta')->paginate($cantidad_productos_pag);
                        return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_en_stock'=>$productos_en_stock,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
                    }else{
                        if($tipo_filtro == "des_precio")
                        {
                            $productos_filtrados = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('familia',$familia)->orderBy('precio_venta','desc')->paginate($cantidad_productos_pag);
                            return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_en_stock'=>$productos_en_stock,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
                        }
                    }
                }
            }
            
        }
        // $productos_filtrados = DB::table('productos')->where('familia',$familia)->orderBy('nombre')->paginate($cantidad_productos_pag);
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
