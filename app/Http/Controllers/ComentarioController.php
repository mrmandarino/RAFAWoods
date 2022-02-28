<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComentarioController extends Controller
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
        $cantidad=$comentarios = DB::table('comentarios')->get()->count();
        if($cantidad<6){ 
            for ($i=0; $i < 6-$cantidad; $i++) { 
                Comentario::create([
                    'rut' => 'default',
                ]);
            }  
        }
        
        $comentarios = DB::table('comentarios')->get();
        return view('inicio.inicio_usuario',compact('comentarios'));
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
           
        DB::table('comentarios')->where('id',$id)->update(['rut'=>$request->rut,'comentario'=>$request->comentario]);
        return redirect()->route('inicio');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         
        DB::table('comentarios')->where('id',$id)->update(['rut'=>'default','comentario'=>""]);
        return redirect()->route('inicio');
    }
}
