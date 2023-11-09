<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('places') }}
        </h2>
    </x-slot>
 
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
            <h1 class="">PLACE</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 bg-white border-b border-gray-200 relative overflow-x-auto">
                 <a href="{{ url('/places/create') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-0 rounded inline-flex items-center">{{ __('ADD Places') }}</a>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                       <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                           <tr>
                               <td scope="col" class="px-3 py-3">Place ID</td>
                               <td scope="col" class="px-3 py-3">Place name</td>
                               <td scope="col" class="px-3 py-3">Place description</td>
                               <td scope="col" class="px-3 py-3">Place File_id</td>
                               <td scope="col" class="px-3 py-3">Place latitude</td>
                               <td scope="col" class="px-3 py-3">Place longitude</td>
                               <td scope="col" class="px-3 py-3">Place category_id</td>
                               <td scope="col" class="px-3 py-3">Place visibility_id</td>
                               <td scope="col" class="px-3 py-3">Place author_id</td>
                               <td scope="col" class="px-3 py-3">Place VERRRR</td>
                               <td scope="col" class="px-3 py-3">Place Editar</td>
                               <td scope="col" class="px-3 py-3">Place BORRAR</td>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($places as $place)
                           <tr>
                                <td class="px-6 py-3">{{ $place->id }}</td>
                                <td class="px-6 py-3"><img class="img-fluid" src="{{ asset("storage/{$place->name}") }}" /></td>
                                <td class="px-6 py-3">{{ $place->description }}</td>
                                <td class="px-6 py-3">{{ $place->file_id }}</td>
                                <td class="px-6 py-3">{{ $place->latitude }}</td>
                                <td class="px-6 py-3">{{ $place->longitude }}</td>
                                <td class="px-6 py-3">{{ $place->category_id }}</td>
                                <td class="px-6 py-3">{{ $place->visibility_id }}</td>
                                <td class="px-6 py-3">{{ $place->author_id }}</td>
                                <td class="px-6 py-3">
                                    <a href="{{ route('places.show', ['place' => $place->id]) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">Ver</a>
                                </td>
                                <td class="px-6 py-3"><a href="{{ route('places.edit', ['place' => $place->id]) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">Editar</a></td>
                               
                                <td class="px-6 py-3">
                                    <form method="POST" action="{{ route('places.destroy', $place) }}">
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