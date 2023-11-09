<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Place') }}
        </h2>
    </x-slot>
 
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form method="post" action="{{ route('places.store') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf

                {{-- <div class="mb-4">
                    <label for="pname" class="block text-gray-700 text-sm font-bold mb-2">Place Name:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="pname" placeholder="Place Name" required>
                </div> --}}
                
                <div class="mb-4">
                    <label for="pdescription" class="block text-gray-700 text-sm font-bold mb-2">Place Description:</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="pdescription" placeholder="Place Description" required></textarea>
                </div>
                
                <div class="mb-4">
                    <label for="file" class="block text-gray-700 text-sm font-bold mb-2">Place File:</label>
                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="upload" required>
                </div>
                
                <div class="mb-4">
                    <label for="platitude" class="block text-gray-700 text-sm font-bold mb-2">Place Latitude:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="platitude" placeholder="Place Latitude" required>
                </div>
                
                <div class="mb-4">
                    <label for="plongitude" class="block text-gray-700 text-sm font-bold mb-2">Place Longitude:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="plongitude" placeholder="Place Longitude" required>
                </div>
                
                <div class="mb-4">
                    <label for="pcatid" class="block text-gray-700 text-sm font-bold mb-2">Place Category ID:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="pcatid" placeholder="Place Category ID" required>
                </div>
                
                <div class="mb-4">
                    <label for="pvisid" class="block text-gray-700 text-sm font-bold mb-2">Place Visibility ID:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="pvisid" placeholder="Place Visibility ID" required>
                </div>

                <div class="mb-6">
                    <label for="pauthor_id" class="block text-gray-700 text-sm font-bold mb-2">Place Author ID:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="pauthor_id" value="{{ auth()->user()->id }}" readonly>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
                    <a href="{{ url('/dashboard') }}" class="text-gray-600">Dashboard</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
