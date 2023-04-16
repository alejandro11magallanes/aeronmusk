<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CodeController;

use App\Http\Controllers\SignedRouteController;

use App\Http\Controllers\Admin\{
    ProfileController,
    MailSettingController,
    PostController,
    VerificationController,
    VerificacionEliminarController,
   
};
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Providers\RouteServiceProvider;
use App\WebSockets\WebSocket;



use App\Http\Controllers\CodeUpdateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    //Rutas a las que se permitirá acceso
    Route::get('/', function () {
        return view('welcome');
    });




Route::get('/test-mail',function(){

    $message = "Testing mail";

    \Mail::raw('Hi, welcome!', function ($message) {
      $message->to('ajayydavex@gmail.com')
        ->subject('Testing mail');
    });

    dd('sent');

});


Route::get('/dashboard', function () {
    $data = DB::table('qrs')->get();
    $tableName = 'qrs';
    return view('front.dashboard', ['tableName' => $tableName, 'data' => $data]);
   // return view('front.dashboard');
})->middleware(['front'])->name('dashboard');


require __DIR__.'/front_auth.php';

// Admin routes
Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','codigomidelware'])->name('admin.dashboard');

require __DIR__.'/auth.php';






Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')
    ->group(function(){
        Route::resource('roles','RoleController');
        Route::resource('permissions','PermissionController');
        Route::resource('users','UserController');
        Route::resource('soft','VerificacionEliminarController');
        Route::resource('posts','PostController')->except(['edit']);
        Route::get('/posts/{post}/verify-code', 'PostController@verifyCode')->name('posts.verify-code');
        Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit')->middleware('updatemidelware');
        Route::get('/posts/{post}/destruir', 'PostController@destruir')->name('posts.destruir');
        Route::resource('codes','VerificationController');
        Route::get('/verificar',[PostController::class, 'verificar'])->name('verificar');
        Route::post('/verificar',[PostController::class, 'guardarPeticion'])->name('pedirc');
        Route::get('/verificareliminar',[PostController::class, 'verificarelim'])->name('verificareliminar');
        Route::post('/verificareliminar',[PostController::class, 'guardarPeticionEliminar'])->name('pedireliminar');
       // Route::resource('codes','PostController');
        Route::get('/profile',[ProfileController::class,'index'])->name('profile');
        Route::put('/profile-update',[ProfileController::class,'update'])->name('profile.update');
        Route::get('/mail',[MailSettingController::class,'index'])->name('mail.index');
        Route::put('/mail-update/{mailsetting}',[MailSettingController::class,'update'])->name('mail.update');
});

Route::get('/mi-ruta',  [CodeController::class, 'miFuncion'])->name('mi-ruta');
Route::post('/mi', [CodeController::class, 'miMetodo'])->name('mi');

Route::get('/firmada', [SignedRouteController::class, 'SignedRoute'])->name('firmada');

Route::get('/verificacion', function () {
    return view('verificacion');
})->name('verificacion');

Route::get('/verificacionqq', function () {
    return view('QR');
})->name('verificacionqq');


Route::get('/verificacionadmin', function () {
    return view('verificacionadmin');
})->name('verificacionadmin');

Route::post('/validacion', [CodeController::class, 'generarWeb'])->name('validacion');
Route::post('/validacionqr', [CodeController::class, 'generarWebQR'])->name('validacionqr');;

Route::get('/check_qr_status/{miParametro}', [CodeController::class, 'checkQRStatus'])->name('check_qr_status');


//Route::middleware(['auth'])->group(function () {
    Route::get('/my-websocket-route', function () {
        $qr = session()->get('mensaje');
    
        // Consultar la base de datos para verificar si el QR está activo
        $activo = DB::table('qrs')->where('Qr', $qr)->value('activo');
    
        if (!$activo) {
            // Si el QR no está activo, redireccionar a una vista
           // return view('inactive-qr');
           return view('QR');
           
        }
    
        // Si el QR está activo, enviar un mensaje al canal de websockets
        event(new App\Events\MyEvent('QR activo'));
        //return view('QR');
       // return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
       return response()->json(['message' => 'Mensaje enviado al canal de websockets.']);
       
       
       
        //return view('QR');
    });


    Route::post('/my-websocket-route', function () {
        $qr = request()->input('qr');
    
        // Consultar la base de datos para verificar si el QR está activo
        $activo = DB::table('qrs')->where('Qr', $qr)->value('activo');
    
        if (!$activo) {
            // Si el QR no está activo, redireccionar a una vista
           // return view('inactive-qr');
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
        }
    
        // Si el QR está activo, enviar un mensaje al canal de websockets
        event(new App\Events\MyEvent('QR activo'));
        //return view('QR');
        return response()->json(['message' => 'Mensaje enviado al canal de websockets.']);
    })->name('my-websocket-route');
//});

Route::get('/websocket', function () {
    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new WebSocket()
            )
        ),
        6001
    );
    $server->run();
});

Route::get('/table', function () {
    $data = DB::table('qrs')->get();
    $tableName = 'qrs';
    return view('table', ['tableName' => $tableName, 'data' => $data]);
})->middleware(['auth']);
