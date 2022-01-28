<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\User;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /*
    public function index(){
        $productos = Producto::distinct()->get('familia');
        return view('admin.test',compact('productos'));
        

    }

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
    */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.crear_usuario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_usuario(Request $request)
    {
        $request->validate([
            'rut' => ['required','cl_rut','unique:users'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required','string','max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8', 'max:16',Rules\Password::defaults()],
            'tipo_trabajador' => ['required'],
        ]);

        $rut_normalizado = Rut::parse($request->rut)->normalize();
        User::create([
            'rut' => $rut_normalizado,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'tipo_usuario' => 2,
        ]);
        
        
        Trabajador::create([
            'usuario_rut' => $rut_normalizado,
            'tipo_trabajador' => $request->tipo_trabajador,
            'sucursal_id' => 1,
        ]);

        return view('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
        $usuarios = DB::table('users')->get();
        $clientes = DB::table('clientes')->get();
        return view('admin.visualizar_datos',compact('usuarios','clientes'));
    }

    public function show2($tabla)
    {
        
        if ($tabla=='usuarios') {
            $datos = DB::table('users')->get();

        }elseif ($tabla=='clientes') {
            $datos=DB::table('clientes')->get();

        }elseif ($tabla=='trabajadores') {
            $datos=DB::table('trabajadors')->get();

        }elseif ($tabla=='madera_proveedores') {
            $datos=DB::table('venta_proveedors')->get();

        }elseif ($tabla=='transportes') {
            $datos=DB::table('transportes')->get();

        }elseif ($tabla=='tornillos') {
            $datos=DB::table('tornillos')->get();

        }elseif ($tabla=='telefono_proveedores') {
            $datos=DB::table('telefono_proveedors')->get();

        }elseif ($tabla=='techumbres') {
            $datos=DB::table('techumbres')->get();

        }elseif ($tabla=='proveedores') {
            $datos=DB::table('proveedors')->get();

        }elseif ($tabla=='productos') {
            $datos=DB::table('productos')->get();

        }elseif ($tabla=='planchas_construccion') {
            $datos=DB::table('plancha_construccions')->get();

        }elseif ($tabla=='muebles') {
            $datos=DB::table('muebles')->get();

        }elseif ($tabla=='maderas') {
            $datos=DB::table('maderas')->get();

        }elseif ($tabla=='sucursal_producto') {
            $datos=DB::table('localizacions')->get();

        }elseif ($tabla=='inventarios') {
            $datos=DB::table('inventarios')->get();

        }elseif ($tabla=='fotos') {
            $datos=DB::table('imagens')->get();

        }elseif ($tabla=='ejecutivos') {
            $datos=DB::table('ejecutivos')->get();

        }elseif ($tabla=='compras') {
            $datos=DB::table('compras')->get();

        }elseif ($tabla=='clavos') {
            $datos=DB::table('clavos')->get();

        }
        
        
        //$datos='0';
        $orientacion='desc';

        return view('admin.visualizar_especifico',compact('datos','tabla','orientacion'));

    }

    public function ordenar($tabla,$sort_by,$orientacion)
    {

        if ($tabla=='usuarios') {
            if($orientacion=='desc'){
                $datos = DB::table('users')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos = DB::table('users')->orderBy($sort_by)->get();
                $orientacion='desc';
            }

        }elseif ($tabla=='clientes') {
            if ($sort_by=='rut') {
                $sort_by='usuario_rut';
            }
            if($orientacion=='desc'){
                $datos=DB::table('clientes')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('clientes')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            
            
        }elseif ($tabla=='trabajadores') {
            if ($sort_by=='rut') {
                $sort_by='usuario_rut';
            }
            if($orientacion=='desc'){
                $datos=DB::table('trabajadors')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('trabajadors')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
             

        }elseif ($tabla=='madera_proveedores') {
            if($orientacion=='desc'){
                $datos=DB::table('venta_proveedors')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('venta_proveedors')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            

        }elseif ($tabla=='transportes') {
            if($orientacion=='desc'){
                $datos=DB::table('transportes')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('transportes')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            

        }elseif ($tabla=='tornillos') {
            if($orientacion=='desc'){
                $datos=DB::table('tornillos')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('tornillos')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            

        }elseif ($tabla=='telefono_proveedores') {
            if($orientacion=='desc'){
                $datos=DB::table('telefono_proveedors')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('telefono_proveedors')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            

        }elseif ($tabla=='techumbres') {
            if($orientacion=='desc'){
                $datos=DB::table('techumbres')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('techumbres')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            

        }elseif ($tabla=='proveedores') {
            if($orientacion=='desc'){
                $datos=DB::table('proveedors')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('proveedors')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            

        }elseif ($tabla=='productos') {
            if($orientacion=='desc'){
                $datos=DB::table('productos')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('productos')->orderBy($sort_by)->get();
                $orientacion='desc';
            }


        }elseif ($tabla=='planchas_construccion') {
            if($orientacion=='desc'){
                $datos=DB::table('plancha_construccions')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('plancha_construccions')->orderBy($sort_by)->get();
                $orientacion='desc';
            }


        }elseif ($tabla=='muebles') {
            if($orientacion=='desc'){
                $datos=DB::table('muebles')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('muebles')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            

        }elseif ($tabla=='maderas') {
            if($orientacion=='desc'){
                $datos=DB::table('maderas')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('maderas')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            

        }elseif ($tabla=='sucursal_producto') {
            if($orientacion=='desc'){
                $datos=DB::table('localizacions')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('localizacions')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            

        }elseif ($tabla=='inventarios') {
            if($orientacion=='desc'){
                $datos=DB::table('inventarios')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('inventarios')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            

        }elseif ($tabla=='fotos') {
            if($orientacion=='desc'){
                $datos=DB::table('imagens')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('imagens')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            

        }elseif ($tabla=='ejecutivos') {
            if($orientacion=='desc'){
                $datos=DB::table('ejecutivos')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('ejecutivos')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
           

        }elseif ($tabla=='compras') {
            if($orientacion=='desc'){
                $datos=DB::table('compras')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('compras')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            

        }elseif ($tabla=='clavos') {
            if($orientacion=='desc'){
                $datos=DB::table('clavos')->orderBy($sort_by,$orientacion)->get();
                $orientacion='asc';
            }else{
                $datos=DB::table('clavos')->orderBy($sort_by)->get();
                $orientacion='desc';
            }
            

        }

        
        return view('admin.visualizar_especifico',compact('datos','tabla','orientacion'));

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
