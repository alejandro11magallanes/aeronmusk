<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Encuestas;



class Encuesta extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Nivel access|Nivel create|Nivel edit|Nivel delete', ['only' => ['index', 'show']]);
        //$this->middleware('role_or_permission:Nivel create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Nivel edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Nivel delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $Post = Encuestas::paginate(4);

        return view('encuestas.index', ['marcas' => $Post]);
    }


    public function create()
    {
        return view('encuestas.new');
    }

    public function edit(Niveledu $marca)
    {

        return view('encuestas.edit', ['marcas' => $marca]);

    }





 
    public function store(Request $request)
{
    // // Validar los datos de entrada, si es necesario
    
    // // Crear una nueva instancia de Encuesta
    // $encuesta = new Encuesta;
    
    // // Asignar los valores de los campos
    // $encuesta->titulo = $request->input('titulo');
    // $encuesta->activado = 1;
    // // Asigna los demás campos de la encuesta si los tienes
    
    // // Guardar la encuesta en la base de datos
    // // $encuesta->save();
    // $Post = Encuestas::create($encuesta);
    // // Redireccionar a la página correspondiente con un mensaje de éxito




    $data = $request->all();
    $marca = new Encuesta;
    $marca->titulo = $data['titulo'];
   // $marca->descripcion = $data['descripcion'];
    
    // Guardar el nivel en la base de datos
    $marca->save();
    
    return redirect()->back()->with('success', 'Se ha creado una encuesta exitosamente.');
    
}




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambiarEstado($id, Request $request)
    {
        // $marca = Niveledu::findOrFail($id);
        // $marca->activado = !$marca->activado;
        // $marca->save();


        // return redirect()->back()->with('success', 'Estado de Nivel educativo cambiado exitosamente.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    
    public function update(Request $request, $id)
    {

        // $request->validate([
        //     'nombre' => 'required|max:255',
        //     'descripcion' => 'required',
        // ]);

        // // Buscar la marca a actualizar en la base de datos
        // $marca = Niveledu::findOrFail($id);
        // $data = $request->all();
        
        // // Actualizar los datos de la marca con los valores recibidos del formulario
        // $marca->nombre = $data['nombre'];
        // $marca->descripcion = $data['descripcion'];
        

        // // Guardar los cambios en la base de datos
        // $marca->save();
        // return redirect()->route('admin.marcas.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id, Niveles $marca)
    {
        // $marca = Niveles::findOrFail($id);
        // $marca->activado = !$marca->activo;
        // $marca->save();

       
        // return redirect()->back()->with('success', 'Estado de Nivel educativo cambiado exitosamente.');
    
    }
}