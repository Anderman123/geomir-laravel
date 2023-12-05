<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('places') }}
            {{-- {{ __('files') }} --}}
        </h2>
    </x-slot>
 
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
            <h1 class="">PLACE</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 bg-white border-b border-gray-200 relative overflow-x-auto">
                 {{-- <a href="{{ url('/places/create') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-0 rounded inline-flex items-center">{{ __('ADD Places') }}</a> --}}
                @can('create',App\Models\Place::class)
                    <a href="{{ url('/places/create') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-0 rounded inline-flex items-center">{{ __('ADD Places') }}</a>
                @endcan
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                       <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                           <tr>
                               <td scope="col" class="px-3 py-3">{{ __('Place ID') }}</td>
                               <td scope="col" class="px-3 py-3">{{ __('Place name') }}</td>
                               <td scope="col" class="px-3 py-3">{{ __('Place image') }}</td>
                               <td scope="col" class="px-3 py-3">{{ __('Place description') }}</td>
                               <td scope="col" class="px-3 py-3">{{ __('Id File Place') }}</td>
                               <td scope="col" class="px-3 py-3">{{ __('Place latitude') }}</td>
                               <td scope="col" class="px-3 py-3">{{ __('Place longitude') }}</td>
                               {{-- <td scope="col" class="px-3 py-3">Place category_id</td>
                               <td scope="col" class="px-3 py-3">Place visibility_id</td> --}}
                               <td scope="col" class="px-3 py-3">{{ __('Place author_id') }}</td>
                               <td scope="col" class="px-3 py-3">{{ __('Place Visibility') }}</td>
                                @can('favourite', $places)
                                    <td scope="col" class="px-3 py-3">{{ __('Favorit') }}</td>
                                @endcan
                               <td scope="col" class="px-3 py-3">{{ __('See Place') }}</td>
                               <td scope="col" class="px-3 py-3">{{ __('Edit Place') }}</td>
                               <td scope="col" class="px-3 py-3">{{ __('Delete Place') }}</td>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($places as $place)
                           <tr>
                                <td class="px-6 py-3">{{ $place->id }}</td>
                                <td class="px-6 py-3">{{ $place->name }}</td>
                                <td class="px-1 py-3"><img class="img-fluid" src="{{ asset("storage/{$place->file->filepath}") }}" /></td>
                                <td class="px-6 py-3">{{ $place->description }}</td>
                                <td class="px-6 py-3">{{ $place->file_id }}</td>
                                <td class="px-6 py-3">{{ $place->latitude }}</td>
                                <td class="px-6 py-3">{{ $place->longitude }}</td>
                                <td class="px-6 py-3">{{ $place->author->name }}</td>
                                <td class="px-6 py-3">
                                    @if($place->visibilities)
                                        {{ __($place->visibilities->name) }}
                                    @else
                                        <span class="text-red-500">{{__('Unspecified')}}</span>
                                    @endif
                                </td>


                                @can('favourite', $place)
                                    <td class="px-6 py-3">
                                        {{ $place->favorited_count }} favs 
                                        @if(auth()->user()->hasPlaceFav($place))
                                            <form method="post" action="{{ route('places.unfavourite', $place) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border: none;background-color: transparent;"><i class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">{{ __('Delete of favorit') }}</i></button>
                                            </form>  
                                        @else
                                            <form method="post" action="{{ route('places.favourite', $place) }}">
                                                @csrf
                                                <button type="submit" style="border: none;background-color: transparent;"><i class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">{{ __('Add to favorit') }}</i></button>
                                            </form>   
                                        @endif  
                                    </td> 
                                @endcan 
                                @can('view',$place)
                                    <td class="px-6 py-3">
                                        <a href="{{ route('places.show', ['place' => $place->id]) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">{{ __('See') }}</a>
                                    </td>
                                @endcan 
                                @can('update',$place)
                                    <td class="px-6 py-3"><a href="{{ route('places.edit', ['place' => $place->id]) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">{{ __('Edit') }}</a></td>
                                @endcan 
                                
                                @can('delete',$place)
                                    <td class="px-6 py-3">
                                        <form method="POST" action="{{ route('places.destroy', $place) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                @endcan 
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
 </x-app-layout>
