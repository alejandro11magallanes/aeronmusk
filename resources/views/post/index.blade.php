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
              <a href="{{route('admin.posts.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Crear producto</a>
            @endcan
          </div>

        <div class="bg-white shadow-md rounded my-6">
          <table class="text-left w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Nombre del producto</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Precio</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Marca</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Imagen</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right w-2/12">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @can('Post access')
                @foreach($posts as $post)
                @if($post->activado)
                <tr class="hover:bg-grey-lighter">
                  <td class="py-4 px-6 border-b border-grey-light">{{ $post->title }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">{{ $post->precio }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">{{ $post->marca }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">
                  <img src="{{Storage::disk('do')->url($post->imagen_url)}}"  alt="...">
                  </td>

                
                  <td class="py-4 px-6 border-b border-grey-light text-right">

                    @can('Post edit')
                    @if(in_array('admin', $nombres))
                    <a href="{{route('admin.verificar',$post->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Editar</a>
                    @elseif(in_array('supervisor', $nombres))
                    <a href="{{route('admin.posts.edit',$post->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Editar</a>
                    @endif
                    @endcan

                    @can('Post delete')
                    <a href="{{route('admin.verificareliminar',$post->id)}}" class="text-red-700 font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-red-500">Eliminar</a>

                    @endcan
                  </td>
                </tr>
                @endif
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
