<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CodeDelete;
use App\Models\Concesionarios;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Marca;
use Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Post access|Post create|Post edit|Post delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Post create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Post edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Post delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Post= Post::paginate(4);
        $marcas = Marca::get();
        $concesionarios = Concesionarios::get();
      
        return view('post.index',['posts'=>$Post,'marcas'=>$marcas,'concesionarios'=>$concesionarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::get();
        $concesionarios = Concesionarios::get();
        return view('post.new',['marcas'=>$marcas,'concesionarios'=>$concesionarios]);
    }
    public function verificar(Request $request)
    {
        $url = $request->getRequestUri();
        $id = substr($url,strpos($url,"?")+1);
      return view('post.verificacion',['id'=>$id]);
    }

    public function verificarelim(Request $request)
    {
        $url = $request->getRequestUri();
        $id = substr($url,strpos($url,"?")+1);
      return view('post.verificareliminar',['id'=>$id]);
    }


   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= $request->all();
        $request->marca = $request->input('marca');
        $request->año = $request->input('año');
        $request->modelo = $request->input('modelo');
        $request->marca_id = $request->input('marca_id');
        $request->con_id = $request->input('con_id');
        $data['user_id'] = Auth::user()->id;
        $archivo = $request->file('image');
        $nombre = $archivo->getClientOriginalName();
        $img = $request->file('image');
        $store = Storage::disk('do')->put('/imagenes/'.$nombre,file_get_contents($request->file('image')->getRealPath()), 'public');
        
        
        
        $folder = '/imagenes/'.$nombre;
        $data['imagen_url'] = $folder;
        $Post = Post::create($data);
        
       // return back()->with('message','Producto creado');
       return redirect()->route('admin.posts.index');
    
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
    public function show($id)
    {
        //
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



    public function edit(Post $post, Request $request)
    {
        $marcas = Marca::get();
        $concesionarios = Concesionarios::get();
        //return view('post.new',['marcas'=>$marcas,'concesionarios'=>$concesionarios]);
  
        return view('post.edit',['post' => $post,'marcas'=>$marcas,'concesionarios'=>$concesionarios]);
    

      

       
    }


    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      

        if ($request->hasFile('image')) {
          $post->marca = $request->input('marca');
          $post->modelo = $request->input('modelo');
          $post->año = $request->input('año');
          $post->marca_id = $request->input('marca_id');
          $post->con_id = $request->input('con_id');
          $archivo = $request->file('image');
            $nombre = $archivo->getClientOriginalName();
             $img = $request->file('image');
             $store = Storage::disk('do')->put('/imagenes/'.$nombre,file_get_contents($request->file('image')->getRealPath()), 'public');
             $folder = '/imagenes/'.$nombre;

          $post->imagen_url = $folder;
        }
        else{
            $post->marca = $request->input('marca');
            $post->modelo = $request->input('modelo');
            $post->año = $request->input('año');
            $post->marca_id = $request->input('marca_id');
            $post->con_id = $request->input('con_id');
            $post->imagen_url = $request->input('imagenguardada');
        }


        $post->save();
        $nombres = [];
        Cookie::queue(Cookie::forget('editar'));
    
        //$post->update($request->all());
        return redirect()->route('admin.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destruir(Post $post, Request $request)
    {
        $nombres = [];
        foreach (auth()->user()->roles as $role) {
            $nombres[] = $role->name; 
        }
        $code = $request->codigo;
      
        if(in_array('supervisor', $nombres)){
            $code = $request->codigo;
          
            $codesverficar = CodeUpdate::where('activo', true)->get();
           


        $codesverficar = CodeDelete::where('activo', true)->get();
        if ($codesverficar->isEmpty()) {
            return redirect()->back()->withSuccess('Este codigo ya se ha usado');
        }
     
        foreach ($codesverficar as $codigover) {
            if (Hash::check($code, $codigover->codigo)) {
                $codigover->activo = false;
                $codigover->save();

                $post->update(['activado' => false]);
                

                return redirect()->back()->withSuccess('El producto se ha eliminado');
            }
        }
        
        return redirect()->back()->withSuccess('Codigo invalido');
    }else if(in_array('admin', $nombres)){
        $post->update(['activado' => false]);
        return redirect()->back()->withSuccess('Producto Eliminado');
    }
    }
}
