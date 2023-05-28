<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Mail\EmailSend;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;
use PDOException;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;
use App\Models\Qrs;



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

        try {
            DB::connection()->getPdo();
            $request->authenticate();

            $request->session()->regenerate();


            $nombres = []; // inicializa el arreglo de nombres vacío


            foreach (auth()->user()->roles as $role) {
                $nombres[] = $role->name; // agrega el nombre del usuario al arreglo de nombres
            }
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
            // if (in_array('docentes', $nombres)) {
            //     return redirect()->intended(RouteServiceProvider::ADMIN_HOME);


            // }
            // //return $nombres; // devuelve el arreglo de nombres
            // else if (in_array('alumnos', $nombres)) {
            //     return redirect()->intended(RouteServiceProvider::ADMIN_HOME);


            // } else if (in_array('admin', $nombres)) {

            //     return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
            // }



        } catch (PDOException $e) {
            // Si hay un error de conexión, mostrar un mensaje de error y redirigir a la página de inicio de sesión
            abort(419, 'Lo siento, tu sesión ha caducado.');
            //return view('vistabd');
        }
    }


    //return redirect()->intended(RouteServiceProvider::ADMIN_HOME);


    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Cookie::queue(Cookie::forget('code'));
        Cookie::queue(Cookie::forget('qr'));
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}