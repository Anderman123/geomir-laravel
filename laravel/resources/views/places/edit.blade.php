<form method="post" action="{{ route('places.update', $place) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="upload">Place:</label>
        <input type="place" class="form-control" name="upload"/>
    </div>
    <button type="submit" class="btn btn-primary">edit</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
 </form>
 <a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a>
 
 