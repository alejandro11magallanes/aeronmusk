<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EditarMiddleware
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

        $nombres = []; // inicializa el arreglo de nombres vacío

        foreach (auth()->user()->roles as $role) {
            $nombres[] = $role->name; // agrega el nombre del usuario al arreglo de nombres
        }
        
        if (in_array('admin', $nombres)) {

            if ($request->hasCookie('editar')) 
            {
                return $next($request);
            }
            else{
                return redirect()->route('admin.dashboard');
            } 
        } else {
            return $next($request);
        }
       
    }
}
