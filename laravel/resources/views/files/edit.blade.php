<form method="post" action="{{ route('files.update', $file) }}" enctype="multipart/form-data">
   @csrf
   @method('PUT')
   <div class="form-group">
       <label for="upload">File:</label>
       <input type="file" class="form-control" name="upload"/>
   </div>
   <button type="submit" class="btn btn-primary">edit</button>
   <button type="reset" class="btn btn-secondary">Reset</button>
</form>
<a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a>


