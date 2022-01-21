<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()

    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        $tipo_usuario = DB::table('users')->where('rut',$request->rut)->value('tipo_usuario');
        if($tipo_usuario == 1){
            return view('dashboard');
        }

        if($tipo_usuario == 2){
            $tipo_trabajador = DB::table('trabajadors')->where('usuario_rut',$request->rut)->value('tipo_trabajador');
            if($tipo_trabajador == 1){
                return view('inventario.portal_inventario');
            }else{
                return view('ventas.portal_ventas');
            }
        }

        if($tipo_usuario == 3){
            return view('catalogo.portal_catalogo');
        }
        //return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
