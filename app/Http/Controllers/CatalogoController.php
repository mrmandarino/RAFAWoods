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
        $productos = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('estado',1)->where('sucursal_id',1)->paginate($cantidad_productos_pag);
        $imagenes = DB::table('imagens')->get();
        //Productos para los filtros
        $productos_familia = Producto::distinct()->get('familia');
        $productos_totales = DB::table('productos')->where('estado',1)->get();
        $familia = "todas";
        return view('catalogo.portal_catalogo',compact('productos','imagenes','cantidad_productos_pag','productos_familia','productos_totales','familia'));
    }

    //Redireccionamiento intermedio para filtro por familia
    public function intermedio(Request $request)
    {
        $familia = $request->input_hidden;
        if($familia == "Todos los productos")
        {
            return redirect()->route('ver_catalogo');
        }
        $familia_aux = EjecutivoController::detectar_nombre($familia);
        if($familia_aux == "")
        {
            return back()->with('familia_erronea','Has ingresado una familia inexistente');
        }   
        return redirect()->route('ver_catalogo_por_familia',['familia'=>$familia]);
    }

    //Redireccionamiento a catalogo filtrado por familia
    public function index_por_familia($familia)
    {
        $cantidad_productos_pag = 6;
        $productos = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('estado',1)->where('sucursal_id',1)->where('familia',$familia)->paginate($cantidad_productos_pag);
        $imagenes = DB::table('imagens')->get();
        $productos_familia = Producto::distinct()->get('familia');
        $productos_totales = DB::table('productos')->where('estado',1)->get();
        return view('catalogo.catalogo_por_familia', compact('productos','imagenes','cantidad_productos_pag','productos_familia','productos_totales','familia'));
    }

    //Redireccionamiento intermedio para detalle de producto
    public function intermedio_producto(Request $request)
    {
        $producto = DB::table('productos')->where('nombre',$request->input_hidden_producto)->first();
        if($producto == null)
        {
            return back()->with('producto_erroneo','Has ingresado un producto inexistente');

        }else{
            $nombre_producto = $producto->nombre;
            return redirect()->route('ver_detalle_producto',['nombre_producto'=>$nombre_producto]);
        }
    }

    //Redireccionamiento para vista de detalle de producto
    public function detalle_producto($nombre_producto)
    {
        //productos para datalists de búsqueda
        $imagenes = DB::table('imagens')->get();
        $productos_familia = Producto::distinct()->get('familia');
        $productos_totales = DB::table('productos')->where('estado',1)->get();

        //Producto en particular
        $producto = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('nombre',$nombre_producto)->first();
        return view('catalogo.detalle_producto',['producto'=>$producto,'imagenes'=>$imagenes,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales]);
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
        $productos_familia = Producto::distinct()->get('familia');
        $productos_totales = DB::table('productos')->where('estado',1)->get();
        $productos_filtrados = null;
        
        //Filtras para todo tipo de producto
        if($familia == "todas"){

            //Filtrar alfabeticamente
            if($tipo_filtro == "asc_alfb")
            {
                $productos_filtrados = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('estado',1)->where('sucursal_id',1)->orderBy('nombre')->paginate($cantidad_productos_pag);
                return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
            }else{
                if($tipo_filtro == "des_alfb")
                {
                    $productos_filtrados = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('estado',1)->where('sucursal_id',1)->orderBy('nombre','desc')->paginate($cantidad_productos_pag);
                    return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
                }else{

                    //Filtrar por precio
                    if($tipo_filtro == "asc_precio"){
                        $productos_filtrados = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('estado',1)->where('sucursal_id',1)->orderBy('precio_venta')->paginate($cantidad_productos_pag);
                        return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
                    }else{
                        if($tipo_filtro == "des_precio")
                        {
                            $productos_filtrados = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('estado',1)->where('sucursal_id',1)->orderBy('precio_venta','desc')->paginate($cantidad_productos_pag);
                            return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
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
                $productos_filtrados = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('estado',1)->where('sucursal_id',1)->where('familia',$familia)->orderBy('nombre')->paginate($cantidad_productos_pag);
                return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
            }else{
                if($tipo_filtro == "des_alfb")
                {
                    $productos_filtrados = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('estado',1)->where('sucursal_id',1)->where('familia',$familia)->orderBy('nombre','desc')->paginate($cantidad_productos_pag);
                    return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
                }else{

                    //Filtrar por precio
                    if($tipo_filtro == "asc_precio"){
                        $productos_filtrados = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('estado',1)->where('sucursal_id',1)->where('familia',$familia)->orderBy('precio_venta')->paginate($cantidad_productos_pag);
                        return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
                    }else{
                        if($tipo_filtro == "des_precio")
                        {
                            $productos_filtrados = DB::table('productos')->join('localizacions','productos.id','=','localizacions.producto_id')->where('estado',1)->where('sucursal_id',1)->where('familia',$familia)->orderBy('precio_venta','desc')->paginate($cantidad_productos_pag);
                            return view('catalogo.catalogo_filtrado',['imagenes'=>$imagenes,'cantidad_productos_pag'=>$cantidad_productos_pag,'productos_familia'=>$productos_familia,'productos_totales'=>$productos_totales,'productos_filtrados'=>$productos_filtrados,'familia'=>$familia,'tipo_filtro'=>$tipo_filtro]);
                        }
                    }
                }
            }
            
        }
        // $productos_filtrados = DB::table('productos')->where('familia',$familia)->orderBy('nombre')->paginate($cantidad_productos_pag);
    }
    

}
