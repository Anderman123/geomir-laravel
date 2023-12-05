<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Files') }}
        </h2>
    </x-slot>

<form id="create-file-form" method="post" action="{{ route('files.store') }}" enctype="multipart/form-data">
   @csrf
   <div class="form-group">
       <label for="upload">File:</label>
       <input type="file" class="form-control" name="upload"/>
       <div id="file-upload-error" class="text-danger" style="color: red; font-size: 20px;"></div>

   </div>
   <button type="submit" class="btn btn-primary">Create</button>
   <button type="reset" class="btn btn-secondary">Reset</button>
</form>
<a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a>
</x-app-layout>