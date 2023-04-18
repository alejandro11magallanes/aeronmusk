<?php

use App\Http\Controllers\Admin\VerificacionEliminarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//CORREO EL
Route::post('/movil', [CodeController::class, 'generarMovil']);
//GENERAR MOVIL QR
Route::post('/qr', [CodeController::class, 'generarMovilqr']);
//UPDATE
Route::post('/qr/update-status', [CodeController::class, 'updateStatus']);
//->name('qr.updateStatus');
Route::get('/codesaut', [VerificacionEliminarController::class, 'index2']);
Route::post('/storecel', [VerificacionEliminarController::class, 'storecel']);