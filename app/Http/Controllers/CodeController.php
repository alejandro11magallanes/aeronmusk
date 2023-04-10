<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Code;
use App\Http\Requests\StoreCodeRequest;
use App\Http\Requests\UpdateCodeRequest;
use App\Events\MyEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Qrs;
use Illuminate\Support\Facades\Auth;
//use Ratchet\Server\IoServer;
//use Ratchet\Http\HttpServer;
//use Ratchet\WebSocket\WsServer;
class CodeController extends Controller
{
    public function generarMovil(Request $request)
    {
        $code_mobil = $request->code;

        $codes = Code::where('activo', true)->get();

        foreach ($codes as $code) {
            if (Hash::check($code_mobil, $code->codigo)) {

                $code->activo = false;

                $code->save();

                $num = random_int(1000, 9999);

                Code::create([
                    'codigo' => Hash::make($num),
                    'activo' => true,
                    'user_id' => $code->user_id,
                ]);

               // return response()->json($num, 200);
                return response()->json(strval($num), 200);

                //return response()->json($num, 200);
            }
        }
        return response()->json('Tu codigo no es valido', 400);
    }


    public function generarWeb(Request $request)
    {
        $code_web = $request->code;

        $codes = Code::where('activo', true)->get();

        foreach ($codes as $code) {
            if (Hash::check($code_web, $code->codigo)) {

                $code->activo = false;

                $code->save();

                Cookie::queue('code', $code_web);

                return redirect('dashboard');
            }
        }
        Session::flash('alert-danger', 'El código ingresado no es válido');
        return redirect()->back();
    }

    public function generarWebQR(Request $request)
    {
        $code_web = $request->code;

        $codes = Code::where('activo', true)->get();

        foreach ($codes as $code) {
            if (Hash::check($code_web, $code->codigo)) {

                $code->activo = false;

                $code->save();

                Cookie::queue('code', $code_web);

                ///GENERO QR Y LO MANDO DESPUES ALA PANTALLA

                $num = random_int(1000, 9999);
                $userid = Auth::id();
                $user = auth()->user();
        
                $code = Qrs::create([
                    'Qr' => $num,
                    'activo' => true,
                    'user_id' => $userid,
                ]);
        
                $code->save();
                $otra = QrCode::size(250) -> generate($num);

                //RETORNO ALA VIEW DE QR COMPACTANDO AL QR
                //return view('QR',compact('otra'));
               // return redirect('verificacionqq',compact('otra'));
             
               // return redirect()->route('check_qr_status')->with(['mensaje' => $otra]);
               return redirect()->route('check_qr_status', ['miParametro' => $num]);
                //return redirect('dashboard');
            }
        }
        Session::flash('alert-danger', 'El código ingresado no es válido');
        return redirect()->back();
    }

    public function generarMovilqr(Request $request)
    {
        $code_web = $request->code;

        $codes = Qrs::where('activo', true)->get();
       
        foreach ($codes as $code) {

           // if (Hash::check($code_mobil, $code->codigo)) {
            if (Hash::check($code_web, $code->Qr)) {

                $code->activo = false;

                $code->save();

                //Cookie::queue('code', $code_web);
                return response()->json(strval("SI JALO LA MIERDA ESA"), 200);
                //return redirect('dashboard');
            }
        } 
         return response()->json(strval("NO JALO LA MIERDA ESA"), 400);
       // Session::flash('alert-danger', 'El código ingresado no es válido');
       // return redirect()->back();
    }


    public function updateStatus(Request $request)
{
    $qrCode = $request->input('qrCode');
    $newStatus = false;

    // Buscar el registro por el código QR
    $qr = Qrs::where('Qr', $qrCode)->first();

    // Actualizar el estado del registro
    $qr->activo = $newStatus;
    $qr->save();

    return redirect()->back();
}





public function checkQRStatus(Request $request,$miParametro)
{   $num2 = $miParametro ;
   // return response()->json([
     //   'ID' => $num2,
  //  ]);
    

  
   // $qr = Qrs::find($num2);
    $miEntrada = Qrs::where('Qr', $num2)->first();
    if ($miEntrada) {
        $miEstado = $miEntrada->activo;
       // return response()->json([
            //   'error' => $miEstado,
             //]);
        // Haz algo con $miEstado
    } else {
        // No se encontró ninguna entrada con ese nombre
    }
   // return response()->json([
   //     'error' => $num,
   // ]);
    if ($miEstado == true) {
        $otra = QrCode::size(250) -> generate($num2);
       // event(new App\Events\MyEvent('QR activo'));
       // return redirect('verificacionqq',compact('otra'));
        return redirect()->route('verificacionqq')->with('mensaje', $otra);
        //return view('livewire.tabla-qr-activa', compact('qrActivos'));
    // echo "event: qr_status\n";
       // echo "data: " . json_encode($miEstado) . "\n\n";
       // ob_flush();
       // flush();
        //sleep(1);

    }else{
      // event(new App\Events\MyEvent('QR Inactivo'));
        return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
       // echo "event: qr_status\n";
       // //echo "data: " . json_encode($miEstado) . "\n\n";
       // ob_flush();
      //  flush();


    }
}

  
}
