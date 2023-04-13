<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
              <h2>Ingresa el codigo de verificacion que te proporciono tu Supervisor</h2>
              <form action="{{ route('admin.posts.verify-code',$id) }}" method="GET" class="inline">
                        @csrf
                        <div class="flex flex-col space-y-2">
                        
                    <input id="title" type="text" name="codigo" value="{{ old('codigo') }}" required
                      placeholder="Codigo de Verificacion" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
                <div class="text-center mt-16 mb-16">
                  <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Verificar</button>
                </div>
                </form>
                <form action="{{ route('admin.pedirc') }}" method="POST" class="inline">
                        @csrf
                        
                <div class="text-center mt-16 mb-16">
                  <button type="submit" class="bg-red-600 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-red-400 transition-colors ">Pedir Codigo</button>
                </div>
              
                </form>
            </div>
        </main>
    </div>
</div>
</x-app-layout>
