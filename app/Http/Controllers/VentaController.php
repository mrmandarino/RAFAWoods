<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Venta;
use Illuminate\Http\Request;
use App\Models\Detalle_venta;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = DB::table('productos')->where('estado',1)->get();
        $productos_en_stock = DB::table('localizacions')->get();
        $clientes = DB::table('clientes')->get();
        $count_ventas = DB::table('ventas')->count('*');//ver cuantos registros hay
        $id_venta = 1;//valor por defecto, será modificado si count_ventas es distinto de 0
        
        if($count_ventas!=0){
            $id_venta = DB::table('ventas')->latest()->value('id') + 1;//rescatar el id_venta mas alto (mas nuevo)
            
        }
        
        return view('ventas.realizar_ventas',compact('productos','productos_en_stock','id_venta','clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'medio_pago' => ['required','numeric'],
            'total_compra' => ['required', 'gt:0'],
        ]);

        if($request->rut_cliente != null)
        {
            $request->validate([
                'rut_cliente' => ['cl_rut'],
            ]);
        }

        if($request->con_factura != null)
        {
            if($request->rut_cliente == null){
                return redirect()->route('ventas.create')->with('incorrecto','Rut requerido.');
            }
        }

        $nuevo_total =0;//nuevo valor de stock de los productos recientemente vendidos
        $total_compra = $request->total_compra;
        $total_compra_coma = str_replace(".","",$total_compra);
        $detalle_ventas = json_decode($request->hidden);
        $utilidad_bruta = 0;

        //calcular utilidad bruta de la venta
        foreach($detalle_ventas as $detalle_venta)
        {
            $precio_compra = DB::table('localizacions')->where('producto_id',$detalle_venta->producto_id)->value('precio_compra');
            $total_producto = $detalle_venta->total_producto;//valor total de lo vendido en este producto (valor de venta x cantidad vendida)
            $cantidad = $detalle_venta->cantidad;
            $utilidad_individual = $total_producto - ($cantidad*$precio_compra);
            $utilidad_bruta = $utilidad_bruta + $utilidad_individual;
            
        }
        $venta = Venta::create([
            'sucursal_id' => 1,
            'medio_de_pago' => $request->medio_pago,
            'vendedor_rut' => $request->rut_vendedor,
            'cliente_rut' => $request->rut_cliente,
            'total_venta' => intval($total_compra_coma),
            'utilidad_bruta' => intval($utilidad_bruta),
        ]);

        if($request->con_factura != null)
        {
            $venta->update(['con_factura'=>1]);
            
        }

        foreach($detalle_ventas as $detalle_venta)
        {
            Detalle_venta::create([
                'venta_id' => $venta->id,
                'cantidad' => $detalle_venta->cantidad,
                'producto_id' => $detalle_venta->producto_id,
                'total_producto' => $detalle_venta->total_producto,
            ]);

            $stock = DB::table('localizacions')->where('producto_id',$detalle_venta->producto_id)->get('stock')->first();
            $nuevo_total = $stock->stock - $detalle_venta->cantidad;
            DB::table('localizacions')->where('producto_id',$detalle_venta->producto_id)->update(['stock'=>$nuevo_total]);
        }


        return redirect()->route('ventas.create')->with('correcto','Venta realizada con éxito.');
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
