<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Docente;
use App\Models\Concesionarios;
use App\Models\Niveledu;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class Concesionario extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Docentes access|Docentes create|Docentes edit|Docentes delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Docentes create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Docentes edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Docentes delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $concesionarios = Docente::with('user')->paginate(4);

    return view('concesionarios.index', compact('concesionarios'));
    
    
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Niveledu::get();
        $usuario = User::whereHas('roles', function ($query) {
            $query->where('name', 'docentes');
        })->get();

        return view('concesionarios.new',['roles'=>$roles,'usuario' =>$usuario]);
        //return view('concesionarios.new');
    }

    public function edit(Concesionarios $concesionarios)
    {
       // $role = Role::get();
        //$marcas->cons;
       return view('concesionarios.edit',['concesionarios'=>$concesionarios]);
       //return view('setting.user.edit',['user'=>$user,'roles' => $role]);
    }
    public function verificar(Request $request)
    {
        $url = $request->getRequestUri();
        $id = substr($url,strpos($url,"?")+1);
      return view('marcas.verificacion',['id'=>$id]);
    }

    public function verificarelim(Request $request)
    {
        $url = $request->getRequestUri();
        $id = substr($url,strpos($url,"?")+1);
      return view('marcas.verificareliminar',['id'=>$id]);
    }


   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nivel_id' => 'required',
            'user_id' => 'required',
            'grado' => 'required',
            'seccion' => 'required',
        ]);
    
        $marca = new Docente;
        $marca->nivel_id = $request->input('nivel_id');
        $marca->user_id = $request->input('user_id');
        $marca->grado = $request->input('grado');
        $marca->seccion = $request->input('seccion');
        $marca->save();
        
        return redirect()->route('admin.concesionarios.index');
    }
    

    public function guardarPeticion(Request $request){
        $datos = $request->all();
        $datos['user_id']= Auth::user()->id;
        $datos['username']= Auth::user()->name;
        $datos['correo']= Auth::user()->email;
        $Verificar = Verificacion::create($datos);
        return redirect()->back()->withSuccess('Espera a que tu supervisor te envie tu codigo al correo que registraste');
    }

    public function guardarPeticionEliminar(Request $request){
        $datos = $request->all();
        $datos['user_id']= Auth::user()->id;
        $datos['username']= Auth::user()->name;
        $datos['correo']= Auth::user()->email;
        $Verificar = VerificacionEliminar::create($datos);
        return redirect()->back()->withSuccess('Espera a que tu administrador te envie tu codigo al correo que registraste');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambiarEstado($id,Request $request)
    {
        $marca = Concesionarios::findOrFail($id);
        $marca->activado = ! $marca->activado;
        $marca->save();
    
        return redirect()->back()->with('success', 'Estado del Concesionario cambiado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function verifyCode(Post $post, Request $request)
     {
        
        $code = $request->codigo;
      
        $codesverficar = CodeUpdate::where('activo', true)->get();
        if ($codesverficar->isEmpty()) {
            return redirect()->back()->withSuccess('Este codigo ya se ha usado');
        }
     
        foreach ($codesverficar as $codigover) {
            if (Hash::check($code, $codigover->codigo)) {
                $codigover->activo = false;
                $codigover->save();
                Cookie::queue('editar', $code);
             return view('post.edit',['post' => $post]);
            }
        }
        
        return redirect()->back()->withSuccess('Codigo invalido');
    
     }



    


    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
       
        $request->validate([
            'nombre' => 'required|max:255',
            'telefono' => 'required|max:10',
            'email' => 'required|max:10',
        ]);
    
        // Buscar la marca a actualizar en la base de datos
        $marca = Concesionarios::findOrFail($id);
    
        // Actualizar los datos de la marca con los valores recibidos del formulario
        $marca->nombre = $request->input('nombre');
        $marca->telefono = $request->input('telefono');
        $marca->email = $request->input('email');
        // Guardar los cambios en la base de datos
        $marca->save();
        return redirect()->route('admin.concesionarios.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request,$id,Concesionario $marca )
{
    $marca = Concesionarios::findOrFail($id);
    $marca->activado = ! $marca->activo;
    $marca->save();

    return redirect()->back()->with('success', 'Estado del concesionario cambiado exitosamente.');
}
    public function destruir(Request $request,$id,Marca $marca )
    {
        //$marca = Marca::findOrFail($id);
        //$marca->activado = ! $marca->activo;
        //$marca->save();
    
       // return redirect()->back()->with('success', 'Estado de marca cambiado exitosamente.');
    }
}

