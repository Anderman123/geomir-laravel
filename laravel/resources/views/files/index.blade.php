<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Files') }}
       </h2>
   </x-slot>


   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 bg-white border-b border-gray-200 relative overflow-x-auto">
                <a href="{{ url('/files/create') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">{{ __('ADD POST') }}</a>
                   <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                          <tr>
                              <td scope="col" class="px-6 py-3">ID</td>
                              <td scope="col" class="px-6 py-3">Filepath</td>
                              <td scope="col" class="px-6 py-3">Filesize</td>
                              <td scope="col" class="px-6 py-3">Created</td>
                              <td scope="col" class="px-6 py-3">Updated</td>
                              <td scope="col" class="px-6 py-3">VERRRR</td>
                              <td scope="col" class="px-6 py-3">Editar</td>
                              <td scope="col" class="px-6 py-3">BORRAR</td>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($files as $file)
                          <tr>
                              <td class="px-6 py-3">{{ $file->id }}</td>
                              <td class="px-6 py-3"><img class="img-fluid" src="{{ asset("storage/{$file->filepath}") }}" /></td>
                              <td class="px-6 py-3">{{ $file->filesize }}</td>
                              <td class="px-6 py-3">{{ $file->created_at }}</td>
                              <td class="px-6 py-3">{{ $file->updated_at }}</td>
                              <td class="px-6 py-3">
                                <a href="{{ route('files.show', ['file' => $file->id]) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">Ver</a>
                            </td>
                              <td class="px-6 py-3"><a href="{{ route('files.edit', ['file' => $file->id]) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">Editar</a></td>
                              
                              <td class="px-6 py-3">
                                <form method="POST" action="{{ route('files.destroy', $file) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">Borrar</button>
                                </form>
                            </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
               </div>
           </div>
       </div>
   </div>
</x-app-layout>