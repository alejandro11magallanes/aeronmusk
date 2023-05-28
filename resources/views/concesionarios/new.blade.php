<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.concesionarios.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col space-y-2">
                                <label for="title" class="text-gray-700 select-none font-medium">Usuarios</label>
                                <select name="user_id">
                                    @foreach($usuario as $role1)
                                        <option value="{{ $role1->id }}">{{ $role1->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <label for="title" class="text-gray-700 select-none font-medium">Niveles</label>
                                <select name="nivel_id">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <label for="title" class="text-gray-700 select-none font-medium">Grado</label>
                                <input id="title" type="text" name="grado" value="{{ old('grado') }}" required placeholder="Escribe el Grado" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label for="title" class="text-gray-700 select-none font-medium">Sección</label>
                                <input id="title" type="text" name="seccion" value="{{ old('seccion') }}" required placeholder="Escribe la Sección" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            </div>
                            <!-- Agrega más inputs aquí -->
                        </div>
                
                        <div class="text-center mt-16 mb-16">
                            <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors">Crear Docente</button>
                        </div>
                    </form>
                </div>
        
                @if(Session::has('message'))
                    <script>
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
</x-app-layout>
