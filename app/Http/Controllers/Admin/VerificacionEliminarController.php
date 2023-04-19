<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VerificacionEliminar;
use App\Http\Requests\StoreVerificacionEliminarRequest;
use App\Http\Requests\UpdateVerificacionEliminarRequest;
use App\Mail\CodigoSend;
use App\Mail\CodigoSendEliminate;
use App\Models\CodeDelete;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class VerificacionEliminarController extends Controller
{

    function __construct()
    {
        $this->middleware('role_or_permission:Codes eliminate|Post create|Post edit|Post delete', ['only' => ['index','show']]);
        // $this->middleware('role_or_permission:Post create', ['only' => ['create','store']]);
        // $this->middleware('role_or_permission:Post edit', ['only' => ['edit','update']]);
        // $this->middleware('role_or_permission:Post delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Post= VerificacionEliminar::paginate(8);

        return view('eliminar.index',['peticiones'=>$Post]);
    }
    public function index2()
    {
        // VerificacionEliminar::all();
         $codesa =  VerificacionEliminar::where('activado', true)->get();
        return response()->json($codesa);
       // return response()->json(['data' => $codesa]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVerificacionEliminarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $num = random_int(1000, 9999);
        $code = CodeDelete::create([
            'codigo' => Hash::make($num),
            'activo' => true,
        ]);
        $code->save();
        Mail::to($request->email)->send(new CodigoSendEliminate($num));
        $verificaciones = VerificacionEliminar::where('activado', true)->get();
        foreach($verificaciones as $verificacions){
            $verificacions->activado = false;
            $verificacions->save();
        }
        return redirect()->back()->withSuccess('Accion autorizada');
    }
    public function storecel(Request $request)
    {
        $correo = $request->input('correo');
       
        $num = random_int(1000, 9999);
        $code = CodeDelete::create([
            'codigo' => Hash::make($num),
            'activo' => true,
        ]);

        $code->save();
        Mail::to(  $correo )->send(new CodigoSendEliminate($num));
        $verificaciones = VerificacionEliminar::where('activado', true)->get();
        foreach($verificaciones as $verificacions){
            $verificacions->activado = false;
            $verificacions->save();
        }

        return response()->json(strval("SI JALO LA MIERDA ESA"), 200);
        //return redirect()->back()->withSuccess('Accion autorizada');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VerificacionEliminar  $verificacionEliminar
     * @return \Illuminate\Http\Response
     */
    public function show(VerificacionEliminar $verificacionEliminar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VerificacionEliminar  $verificacionEliminar
     * @return \Illuminate\Http\Response
     */
    public function edit(VerificacionEliminar $verificacionEliminar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVerificacionEliminarRequest  $request
     * @param  \App\Models\VerificacionEliminar  $verificacionEliminar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVerificacionEliminarRequest $request, VerificacionEliminar $verificacionEliminar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VerificacionEliminar  $verificacionEliminar
     * @return \Illuminate\Http\Response
     */
    public function destroy(VerificacionEliminar $verificacionEliminar)
    {
        //
    }
}
