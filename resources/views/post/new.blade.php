
<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
              <div class="bg-white shadow-md rounded my-6 p-5">
                <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 select-none font-medium">Producto</label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}" required
                      placeholder="Escribe el nombre del producto" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 select-none font-medium">Precio</label>
                    <input id="title"type="number" step="0.01" min="0" max="9999.99" name="precio" required value="{{ old('precio') }}"
                      placeholder="Escribe el precio del producto" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 select-none font-medium">Marca</label>
                    <input id="title" type="text" name="marca" required value="{{ old('marca') }}"
                      placeholder="Escribe la marca del producto" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
        
                <div class="flex flex-col space-y-2">
                    <label for="description" class="text-gray-700 select-none font-medium">Imagen</label>
                    <input required class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"  type="file" name="image">
                </div>
    
               
                <div class="text-center mt-16 mb-16">
                  <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Crear producto</button>
                </div>
              </div>

              @if(Session::has('message'))
<script >

    swal("Message","{{Session::get('message')}}",'success',{
      button:true,
      button:"OK",
      timer:3000
    })
 
  </script>
  @endif
            </div>
        </main>
    </div>
</div>

</x-app-layout>

