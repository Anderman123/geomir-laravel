<form method="post" action="{{ route('places.update', $place) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="place_name">Nom</label>
        <input type="text" id="place_name" name="place_name" value="{{ $place->name }}">
    </div>

    <div class="form-group">
        <label for="place_description">Descripció</label>
        <input type="text" id="place_description" name="place_description" value="{{ $place->description }}">
    </div>

    <div class="form-group">
        <label for="upload">File</label>
        <input type="file" id="upload" name="upload">
    </div>

    <div class="form-group">
        <label for="place_latitude">Latitude</label>
        <input type="text" id="place_latitude" name="place_latitude" value="{{ $place->latitude }}">
    </div>

    <div class="form-group">
        <label for="place_longitude">Longitude</label>
        <input type="text" id="place_longitude" name="place_longitude" value="{{ $place->longitude }}">
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
</form>
