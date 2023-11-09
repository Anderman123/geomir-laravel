{{-- <x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Places') }}
       </h2>
   </x-slot>


   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 bg-white border-b border-gray-200">
                   <table class="table">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                          <tr>
                              <td scope="col">ID</td>
                              <td scope="col">Filepath</td>
                              <td scope="col">Filesize</td>
                              <td scope="col">Created</td>
                              <td scope="col">Updated</td>
                              <td scope="col">Boton</td>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td class="px-6 py-3">{{ $place->id }}</td>
                            <td class="px-6 py-3"><img class="img-fluid" src="{{ asset("storage/{$place->filepath}") }}" /></td>
                            <td class="px-6 py-3">{{ $place->filesize }}</td>
                            <td class="px-6 py-3">{{ $place->created_at }}</td>
                            <td class="px-6 py-3">{{ $place->updated_at }}</td>
                            <!-- <td class="px-6 py-3"><a class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">Borrar</td> -->
                            <td class="px-6 py-3">
                                <form method="POST" action="{{ route('places.destroy', $place) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">Borrar</button>
                                </form>
                            </td>
                        </tr>
                      </tbody>
                  </table>
               </div>
           </div>
       </div>
   </div>
</x-app-layout> --}}
