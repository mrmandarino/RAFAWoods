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
            //dd($request->_familia);
            $familia = $request->input('_producto');
            $id_producto = $request->input('_familia');//es el id del producto en la tabla productos
            $tipo_submit = $request->input('action');
            $producto_en_stock = DB::table('localizacions')->where('producto_id',$id_producto)->first(); 
            $producto_en_bruto = DB::table('productos')->where('id',$id_producto)->first();
            if($tipo_submit=="detalle"){  
                return view('inventario.detalle_producto',compact('producto_en_stock','producto_en_bruto'));
            }
        }
        else{
            $var=$request->producto_en_stock_redirect;
            $id_producto_redirect=$var['producto_id'];
            //dd(json_encode($request->producto_en_stock_redirect));
            
            $producto_en_stock = DB::table('localizacions')->where('producto_id',$id_producto_redirect)->first(); 
            $producto_en_bruto = DB::table('productos')->where('id',$id_producto_redirect)->first();
            return view('inventario.detalle_producto',compact('producto_en_stock','producto_en_bruto'));

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
        return redirect()->route('ver_detalle',['producto_en_stock_redirect'=>$producto_en_stock,'producto_en_bruto_redirect'=>$producto_en_bruto])->with('correcto','Stock actualizado correctamente');
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
