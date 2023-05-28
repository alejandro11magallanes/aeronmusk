<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SignedRouteController extends Controller
{
    public function SignedRoute(Request $request)
    {
        // verificar la firma de la URL
        if (!$request->hasValidSignature()) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            abort(401, 'Se ha modificado la Ruta o el tiempo de la misma expiro');
        }

        $longitud = 8;
        $cadena = Str::random($longitud);


        $correo = $request->get('correo');

        //return response()->json(['mensaje' =>  $request ], 400);
        // Buscar el correo en la base de datos
        $usuario = User::where('email', $correo)->first();

       
        if ($usuario) {
            // Cambiar la contraseña del usuario
           
            $usuario->password = bcrypt($cadena);
            $usuario->save();
        } else {
             return response()->json(['mensaje' =>  'NO EXISTE EL USUARIO' ], 400);
            // El usuario no existe, manejar el error adecuadamente
            // ...
        }
       

        // return view('correo')->with('correo', $cadena);
        // if (Auth::check()) {
        //     $user = Auth::user();
        
        //     // Generar nueva contraseña
          
        
        //     // Actualizar la contraseña del usuario
        //     $user->password = Hash::make($cadena);
        //     $user->save();
            //return view('correo', ['data' => $cadena]);

        // } else {
        //     // El usuario no está autenticado, manejar el error adecuadamente
        //     // ...
        // }
        // $user = Auth::user();
        
        // //     // Generar nueva contraseña
          
        
        // //     // Actualizar la contraseña del usuario
        //     $user->password = Hash::make($cadena);
        //     $user->save();
         //return view('correo', compact('cadena'));
       

        // Utiliza el valor de $correo como necesites en tu lógica

       
        return view('correo')->with('correo', $correo)->with('cadena', $cadena);

     // return response()->json(['mensaje' => $request], 400);



        

      
    }
}

        
            // Envío de correo electrónico
            // ...
        