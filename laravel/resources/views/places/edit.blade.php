<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Place') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form id="edit-file-form" method="post" action="{{ route('places.update', $place) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="place_name" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="place_name" name="place_name" value="{{ $place->name }}">
                </div>

                <div class="form-group">
                    <label for="place_description" class="block text-gray-700 text-sm font-bold mb-2">Descripció</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="place_description" name="place_description" value="{{ $place->description }}">
                </div>

                <div class="form-group">
                    <label for="upload" class="block text-gray-700 text-sm font-bold mb-2">File</label>
                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="upload" name="upload">
                </div>

                <div class="form-group">
                    <label for="place_latitude" class="block text-gray-700 text-sm font-bold mb-2">Latitude</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="place_latitude" name="place_latitude" value="{{ $place->latitude }}">
                </div>

                <div class="form-group">
                    <label for="place_longitude" class="block text-gray-700 text-sm font-bold mb-2">Longitude</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="place_longitude" name="place_longitude" value="{{ $place->longitude }}">
                </div>
                
                <div class="mb-6">
                    <select name="visibilities_id">
                        @foreach($visibilities as $visibility)
                            <option value="{{ $visibility->id }}">{{ $visibility->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="display: flex;justify-content: center;">
                    <button type="submit" class="btn btn-primary" style="margin:5px;">Edit</button>
                    <a href="{{ route('places.show', $place) }}" class="btn btn-secondary" style="margin:5px;">Volver</a>
                </div>
                <div id="file-upload-error-edit" class="text-danger" style="color: red; font-size: 20px;"></div>
            </form>
        </div>
    </div>
</x-app-layout>