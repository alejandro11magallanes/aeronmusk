<x-app-layout>
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-2">
         

        <div class="bg-white shadow-md rounded my-6">
          <table class="text-left w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Usuario</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Correo</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right w-2/12">Acciones</th>
              </tr>
            </thead>
            <tbody>
                @foreach($peticiones as $peticion)
                @if($peticion->activado)
                <tr class="hover:bg-grey-lighter">
                  <td class="py-4 px-6 border-b border-grey-light">{{ $peticion->username }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">{{ $peticion->correo }}</td>
                  
                
                  <td class="py-4 px-6 border-b border-grey-light text-right">


                 
                    <form action="{{ route('admin.soft.store') }}" method="POST" class="inline">
                        @csrf
                        <input type="text" hidden name="email" value="{{ $peticion->correo }}">
                        <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-green-900">Enviar Correo</button>
                    </form>
                
                  </td>
                </tr>
                @endif
                @endforeach
             
            </tbody>
          </table>

          
        </div>

      </div>
  </main>
</div>

</x-app-layout>
