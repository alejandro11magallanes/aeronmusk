<x-app-layout>
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-2">
      @php
    $nombres = [];
    foreach (auth()->user()->roles as $role) {
        $nombres[] = $role->name; 
    }
@endphp
          <div class="text-right">
            @can('Nivel create')
              <a href="{{route('admin.encuestas.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Crear Encuesta</a>
            @endcan
          </div>

        <div class="bg-white shadow-md rounded my-6">
          <table class="text-left w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/16">Nombre del la encuesta</th>
                
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/8">Estado</th>
             
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-center w-2/8">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @can('Nivel access')
                @foreach($marcas as $post)
               
                <tr class="hover:bg-grey-lighter">
                  <td class="py-4 px-6 border-b border-grey-light">{{ $post->titulo }}</td>

                  @if($post->activado)
                  <td class="py-4 px-6 border-b border-grey-light">Activo</td>
@else
    
    
                    <td class="py-4 px-6 border-b border-grey-light">Inactivo</td>
@endif
                
                  

                
                  <td class="py-4 px-6 border-b border-grey-light text-right">

                  <a href="{{route('admin.encuestas.edit',$post->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Editar</a>
                  <td>
    <form action="{{ route('encuestas.cambiarestado', $post->id) }}" method="POST">
        @csrf
        <button type="submit" class="text-red-700 font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-red-500">{{ $post->activado ? 'Desactivar' : 'Activar' }}</button>
    </form>
</td>




                    
                  </td>
                </tr>
              
                @endforeach
                @endcan
            </tbody>
          </table>

          @can('Nivel access')
          <div class="text-right p-4 py-10">
            {{ $marcas->links() }}
          </div>
          @endcan
        </div>

      </div>
  </main>
</div>

</x-app-layout>
