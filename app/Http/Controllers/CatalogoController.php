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
        return view('catalogo.portal_catalogo',compact('productos','imagenes','cantidad_productos_pag','productos_en_stock','productos_familia','productos_totales'));
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
        return view('catalogo.catalogo_por_familia', compact('productos','imagenes','cantidad_productos_pag','productos_en_stock','productos_familia','productos_totales'));
    }

    public function intermedio_producto(Request $request)
    {
        $nombre_producto = $request->input_hidden_producto;
        return redirect()->route('ver_detalle_producto',['nombre_producto'=>$nombre_producto]);
    }

    public function detalle_producto($nombre_producto)
    {
        dd($nombre_producto);
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
