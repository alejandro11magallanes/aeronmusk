<style>

.content-select select{
	appearance: none;
	-webkit-appearance: none;
	-moz-appearance: none;


  .content-select{
	max-width: 250px;
	position: relative;
}
 
.content-select select{
	display: inline-block;
	width: 100%;
	cursor: pointer;
  	padding: 7px 10px;
  	height: 42px;
  	outline: 0; 
  	border: 0;
	border-radius: 0;
	background: #f0f0f0;
	color: #7b7b7b;
	font-size: 1em;
	color: #999;
	font-family: 
	'Quicksand', sans-serif;
	border:2px solid rgba(0,0,0,0.2);
    border-radius: 12px;
    position: relative;
    transition: all 0.25s ease;
}
 
.content-select select:hover{
	background: #B1E8CD;
}
 
/* 
Creamos la fecha que aparece a la izquierda del select.
Realmente este elemento es un cuadrado que sólo tienen
dos bordes con color y que giramos con transform: rotate(-45deg);
*/
.content-select i{
	position: absolute;
	right: 20px;
	top: calc(50% - 13px);
	width: 16px;
	height: 16px;
	display: block;
	border-left:4px solid #2AC176;
	border-bottom:4px solid #2AC176;
	transform: rotate(-45deg); /* Giramos el cuadrado */
	transition: all 0.25s ease;
}
 
.content-select:hover i{
	margin-top: 3px;
}
}
</style>

<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.users.store')}}">
                        @csrf
                        @method('post')
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col space-y-2">
                                <label for="name" class="text-gray-700 select-none font-medium">Nombre de usuario</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}"
                                    placeholder="Escribe el nombre del usuario"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                                />
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label for="apaterno" class="text-gray-700 select-none font-medium">Apellido paterno</label>
                                <input id="apaterno" type="text" name="apaterno" value="{{ old('apaterno') }}"
                                    placeholder="Ingresa el apellido paterno"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                                />
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label for="email" class="text-gray-700 select-none font-medium">Correo electronico</label>
                                <input id="email" type="text" name="email" value="{{ old('email') }}"
                                    placeholder="Ingresa correo electronico"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                                />
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label for="amaterno" class="text-gray-700 select-none font-medium">Apellido materno</label>
                                <input id="amaterno" type="text" name="amaterno" value="{{ old('amaterno') }}"
                                    placeholder="Ingresa el apellido materno"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                                />
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label for="password" class="text-gray-700 select-none font-medium">Contraseña</label>
                                <input id="password" type="password" name="password" value="{{ old('password') }}"
                                    placeholder="Ingresa contraseña"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                                />
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label for="password_confirmation" class="text-gray-700 select-none font-medium">Confirmar contraseña</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    placeholder="Confirma la contraseña"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                                />
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label for="fechanacimiento" class="text-gray-700 select-none font-medium">Fecha de nacimiento</label>
                                <input id="fechanacimiento" type="text" name="fechanacimiento" value="{{ old('fechanacimiento') }}"
                                    placeholder="Ingresa la fecha de nacimiento"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                                />
                            </div>
                            <div class="flex flex-col space-y-2">


                            
                            <label for="fechanacimiento" class="text-gray-700 select-none font-medium">Selecciona el rol</label>

                            <select name="roles[]">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            </div>

                            

                            <div class="text-center mt-16 mb-16">
                                <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

