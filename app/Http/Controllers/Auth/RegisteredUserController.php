<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'rut' => ['required','cl_rut','unique:users'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required','string','max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8', 'max:16',Rules\Password::defaults()],
        ]);

        $rut_normalizado = Rut::parse($request->rut)->normalize();

        $usuario = User::create([
            'rut' => $rut_normalizado,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
        ]);

        /*Cliente::create([
            'rut' => $request->rut,
            'telefono' => 
        ]);*/
        
        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect(RouteServiceProvider::HOME);
    }
}
