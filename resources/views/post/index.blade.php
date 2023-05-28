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
            @can('Post create')
              <a href="{{route('admin.posts.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Crear Vehiculo</a>
            @endcan
          </div>

        <div class="bg-white shadow-md rounded my-6">
          <table class="text-left w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Marca</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Año</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Modelo</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Linea</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Concesionario</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Estado</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Imagen</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right w-2/12">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @can('Post access')
                @foreach($posts as $post)
              
                <tr class="hover:bg-grey-lighter">
                  <td class="py-4 px-6 border-b border-grey-light">{{ $post->marca }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">{{ $post->año }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">{{ $post->modelo }}</td>
                  
                  <td class="py-4 px-6 border-b border-grey-light">  {{ $post->marca_id }}
                  <td class="py-4 px-6 border-b border-grey-light">  {{ $post->con_id }}
                 
                 

                  </td>
                  @if($post->activado)
                  <td class="py-4 px-6 border-b border-grey-light">Activo</td>
@else
    
    
    <td class="py-4 px-6 border-b border-grey-light">Inactivo</td>
@endif
                  <td class="py-4 px-6 border-b border-grey-light">
                  <img src="{{Storage::disk('do')->url($post->imagen_url)}}"  alt="...">
                  </td>

                
                  <td class="py-4 px-6 border-b border-grey-light text-right">

                   
                   




                    @can('Post delete')
                    @if(in_array('admin', $nombres))
                    <a href="{{route('admin.posts.destruir',$post->id)}}" class="text-red-700 font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-red-500">Eliminar</a>

                    @elseif(in_array('supervisor', $nombres))
                    <a href="{{route('admin.verificareliminar',$post->id)}}" class="text-red-700 font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-red-500">Eliminar</a>
                    @endif

                    @endcan
                  </td>
                </tr>
              
                @endforeach
                @endcan
            </tbody>
          </table>

          @can('Post access')
          <div class="text-right p-4 py-10">
            {{ $posts->links() }}
          </div>
          @endcan
        </div>

      </div>
  </main>
</div>

</x-app-layout>
