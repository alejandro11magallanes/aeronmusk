<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
              <div class="bg-white shadow-md rounded my-6 p-5">
                <form method="POST" action="{{ route('admin.concesionarios.update',$concesionarios->id)}}" enctype="multipart/form-data">
                  @csrf
                  
                  @method('put')

                   <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 select-none font-medium">Nombre</label>
                    <input id="title" type="text" name="nombre" value="{{ old('nombre',$concesionarios->nombre) }}" required
                      placeholder="Escribe el nombre" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 select-none font-medium">Telefono</label>
                    <input id="title" type="text" name="telefono" value="{{ old('telefono',$concesionarios->telefono) }}" required
                      placeholder="Escribe el numero telefonico" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
               
                <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 select-none font-medium">Email</label>
                    <input id="title" type="text" name="correo" value="{{ old('correo',$concesionarios->correo) }}" required
                      placeholder="Escribe el correo" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
                
                
        
                
    
                
                <div class="text-center mt-16 mb-16">
                  <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Actualizar</button>
                </div>
              </div>

             
            </div>
        </main>
    </div>
</div>
</x-app-layout>