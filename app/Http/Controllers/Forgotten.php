<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSend;
use App\Models\User;


class Forgotten extends Controller
{
    public function index()
    { 
        return view('forgotenpass');
}


public function enviarCorreo(Request $request)
{
    $correo = $request->input('correo');

    // Lógica para enviar el correo
    // Aquí puedes utilizar la clase Mail de Laravel para enviar el correo
    
    // Ejemplo de envío de correo utilizando la clase Mail y una clase de correo personalizada

    $usuario = User::where('email', $correo)->first();
    if (!$usuario) {
        return response()->json(['mensaje' => 'El correo no se encuentra registrado en el sistema'], 400);
    }
    //Mail::to($correo)->send(new CodigoSend());
    Mail::to($request->correo)->send(new EmailSend(($correo)));
     return view('code');
    // Retorna una respuesta adecuada en caso de éxito o fallo
    //return response()->json(['mensaje' => 'Correo enviado correctamente']);
}

}