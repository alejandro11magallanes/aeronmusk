<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
              <div class="bg-white shadow-md rounded my-6 p-5">
                <form method="POST" action="{{ route('admin.posts.update',$post->id)}}" enctype="multipart/form-data">
                  @csrf
                  @method('put')

                  <div class="text-right">
        
              <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Actualizar</button>

           
          </div>
                  <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 select-none font-medium">Marca</label>
                    <input id="title" type="text" name="marca" value="{{ old('marca',$post->marca) }}"
                      placeholder="Escribe la Marca" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>

                

                <div class="flex flex-col space-y-1">
                    <label for="title" class="text-gray-700 select-none font-medium">Modelo</label>
                    <input id="title" type="text" name="modelo" value="{{ old('modelo',$post->modelo) }}" required
                      placeholder="Escribe el modelo" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 select-none font-medium">Año</label>
                    <input id="title" type="text" name="año" value="{{ old('año',$post->año) }}"
                      placeholder="Escribe el Año" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
               
               

                


                <div class="flex flex-col space-y-1">
                    <label for="title" class="text-gray-700 select-none font-medium">CONCESIONARIOS</label>
                   
                    <select name="con_id" required value="{{ old('con_id') }}" >
                      @foreach($concesionarios as $concesionario)
                  <option value="{{ $concesionario->id }}" name="con_id" >{{ $concesionario->nombre }}</option>
                     @endforeach
                   
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 select-none font-medium">Imagen</label>
                    <img src="{{Storage::disk('do')->url($post->imagen_url)}}" width="20%" alt="...">
                </div>
                <input type="text" hidden name="imagenguardada" value="{{ old('title',$post->imagen_url) }}">
                <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 select-none font-medium">NuevaImagen</label>
                    <input class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"  type="file" name="image">
                    
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 select-none font-medium">LINEA</label>
                   
                    <select name="marca_id" required value="{{ old('marca_id') }}" >
  @foreach($marcas as $marca)
    <option value="{{ $marca->id }}" name="marca_id" >{{ $marca->nombre }}</option>
  @endforeach
                   
                </div>
        
                
    
                
              
              </div>

             
            </div>
        </main>
    </div>
</div>
</x-app-layout>