<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Place') }}
        </h2>
    </x-slot>
 
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form id="create-file-form" method="post" action="{{ route('places.store') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div id="file-upload-error" class="text-danger" style="color: red; font-size: 20px;"></div>


                <div class="mb-4">
                    <label for="pname" class="block text-gray-700 text-sm font-bold mb-2">Place Name:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="place_name" placeholder="Place Name">
                </div>
                
                <div class="mb-4">
                    <label for="pdescription" class="block text-gray-700 text-sm font-bold mb-2">Place Description:</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="place_description" placeholder="Place Description"></textarea>
                </div>
                
                <div class="mb-4">
                    <label for="file" class="block text-gray-700 text-sm font-bold mb-2">Place File:</label>
                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="upload">
                </div>
                
                <div class="mb-4">
                    <label for="platitude" class="block text-gray-700 text-sm font-bold mb-2">Place Latitude:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="place_latitude" placeholder="Place Latitude">
                </div>
                
                <div class="mb-4">
                    <label for="plongitude" class="block text-gray-700 text-sm font-bold mb-2">Place Longitude:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="place_longitude" placeholder="Place Longitude">
                </div>

                {{-- <div class="mb-6">
                    <label for="pauthor_id" class="block text-gray-700 text-sm font-bold mb-2">Place Author ID:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="place_author_id" value="{{ auth()->user()->id }}" readonly>
                </div> --}}
                
                <div class="mb-6">
                    <select name="visibilities_id">
                        @foreach($visibilities as $visibility)
                            <option value="{{ $visibility->id }}">{{ $visibility->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
                    <a href="{{ url('/dashboard') }}" class="text-gray-600">Dashboard</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

