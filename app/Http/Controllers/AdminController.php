<?php

namespace App\Http\Controllers;

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
            $datos=DB::table('users')->get();

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

        return view('admin.visualizar_especifico',compact('datos','tabla'));

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
