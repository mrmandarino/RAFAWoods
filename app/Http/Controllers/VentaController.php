<?php

namespace App\Http\Controllers;

use App\Models\Detalle_venta;
use App\Models\Venta;
use Illuminate\Http\Request;
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
        $productos = DB::table('productos')->get();
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
        dd($request->hidden);
        // $request->validate([
        //     'rut' => ['required','cl_rut','unique:users'],
        //     'nombre' => ['required', 'string', 'max:255'],
        //     'apellido' => ['required','string','max:255'],
        //     'correo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'confirmed', 'min:8', 'max:16',Rules\Password::defaults()],
        //     'telefono' => ['digits:8', 'integer'],
        // ]);
        $nuevo_total =0;
        $total_compra = $request->total_compra;
        $total_compra_coma = str_replace(".","",$total_compra);
        $detalle_ventas = json_decode($request->hidden);
        $venta = Venta::create([
            'sucursal_id' => 1,
            'medio_de_pago' => $request->medio_pago,
            'cliente_rut' => $request->rut_cliente,
            'total_venta' => intval($total_compra_coma),
        ]);

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


        return redirect()->route('ventas.create')->with('correcto','Venta Exitosa');
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
