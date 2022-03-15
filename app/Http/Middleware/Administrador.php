<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Administrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $tipo_usuario = auth()->user()->tipo_usuario;
        if($tipo_usuario == 1 or $tipo_usuario == 2)//admin o trabajador
        {   
            if ($tipo_usuario == 1) //admin
            {
                return $next($request);               
            } 
            $tipo_trabajador = DB::table('trabajadors')->where('usuario_rut',auth()->user()->rut)->value('tipo_trabajador');
            if ($tipo_trabajador == 1) //ejecutivo
            {
                return redirect()->route('inicio');               
            }
            else 
            {
                return redirect()->route('inicio');//vendedor
            }       
        }

        return route('/');
    }
}
