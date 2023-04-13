<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Verificacion;
use App\Http\Requests\StoreVerificacionRequest;
use App\Http\Requests\UpdateVerificacionRequest;
use App\Mail\CodigoSend;
use App\Models\CodeUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{

    function __construct()
    {
        $this->middleware('role_or_permission:Codes access|Post create|Post edit|Post delete', ['only' => ['index','show']]);
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
        $Post= Verificacion::paginate(8);

        return view('codigos.index',['peticiones'=>$Post]);
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
     * @param  \App\Http\Requests\StoreVerificacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $num = random_int(1000, 9999);
        $code = CodeUpdate::create([
            'codigo' => Hash::make($num),
            'activo' => true,
        ]);
        $code->save();
        Mail::to($request->email)->send(new CodigoSend($num));
        $verificaciones = Verificacion::where('activado', true)->get();
        foreach($verificaciones as $verificacions){
            $verificacions->activado = false;
            $verificacions->save();
        }
        return redirect()->back()->withSuccess('Accion autorizada');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Verificacion  $verificacion
     * @return \Illuminate\Http\Response
     */
    public function show(Verificacion $verificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Verificacion  $verificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Verificacion $verificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVerificacionRequest  $request
     * @param  \App\Models\Verificacion  $verificacion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVerificacionRequest $request, Verificacion $verificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Verificacion  $verificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verificacion $verificacion)
    {
        //
    }
}
