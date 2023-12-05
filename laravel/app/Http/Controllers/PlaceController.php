<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Favorite;
use App\Models\File;
use App\Models\Visibility;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     public function __construct()
     {
         $this->authorizeResource(Place::class,'place');
     }

    public function index()
    {
        $places = Place::withCount('favorited')->get();
        // dd(auth()->user());
        return view("places.index", [
            "places" => $places,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // return view("places.create");
        $visibilities = Visibility::all(); // Obtener todas las visibilidades disponibles
        return view("places.create", ["visibilities" => $visibilities]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validar fitxer
        $validatedData = $request->validate([
            'place_name' => 'required',
            'place_description' => 'required',
            'place_latitude' => 'required',
            'place_longitude' => 'required',
            // 'place_category_id' => 'required',
            // 'place_visibility_id' => 'required',
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024'
        ]);
    
        // Obtenir dades del fitxer
        $upload = $request->file('upload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");

        // Pujar fitxer al disc dur
        $uploadName = time() . '_' . $fileName;
        $filePath = $upload->storeAs(
            'uploads',      // Path
            $uploadName ,   // Filename
            'public'        // Disk
        );
    
        if (\Storage::disk('public')->exists($filePath)) {
            \Log::debug("Local storage OK");
            $fullPath = \Storage::disk('public')->path($filePath);
            \Log::debug("File saved at {$fullPath}");
            // Desar dades a BD
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);
            \Log::debug("DB storage OK");
            $place = Place::create([
                'name' =>$request->input('place_name'),
                'description' =>$request->input('place_description'),
                'file_id' =>$file->id,
                'latitude' =>$request->input('place_latitude'),
                'longitude' =>$request->input('place_longitude'),
                // 'category_id' =>$request->input('place_category_id'),
                // 'visibility_id' =>$request->input('place_visibility_id'),
                'visibilities_id' => $request->input('visibilities_id'),
                'author_id' =>auth()->user()->id,
            ]);
            \Log::debug("DB storage OK");
            return redirect()->route('places.show', $place)
                ->with('success', __('Place successfully saved'));
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("places.create")
                ->with('error', __('ERROR uploading file'));
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        $place->load('user', 'file', 'favorited'); // Cargar relaciones: usuario, archivo y favoritos
    
        $control = $place->favorited->contains(auth()->id()); // Verificar si el usuario autenticado ha marcado este lugar como favorito
    
        return view("places.show", [
            "place" => $place,
            "file" => $place->file,
            "autor" => $place->user,
            "control" => $control,
            "favorites" => $place->favorited_count, // Conteo de favoritos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        //
        // return view("places.edit", ["place" => $place]);
        $visibilities = Visibility::all(); // Obtener todas las visibilidades disponibles
        return view("places.edit", ["place" => $place, "visibilities" => $visibilities]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        // Validar archivo
        $validatedData = $request->validate([
            'upload' => 'mimes:gif,jpeg,jpg,png|max:1024'
        ]);

        $file = File::find($place->file_id);
        
        // Obtener datos del archivo
        $upload = $request->file('upload');
        $controlNull = false;

        if (!is_null($upload)) {
            $fileName = $upload->getClientOriginalName();
            $fileSize = $upload->getSize();

            // Subir archivo al disco
            $uploadName = time() . '_' . $fileName;
            $filePath = $upload->storeAs(
                'uploads',      // Ruta
                $uploadName,    // Nombre del archivo
                'public'        // Disco
            );
        } else {
            $filePath = $file->filepath;
            $fileSize = $file->filesize;
            $controlNull = true;
        }

        if (\Storage::disk('public')->exists($filePath)) {
            if ($controlNull == false) {
                \Storage::disk('public')->delete($file->filepath);
                $file->filepath = $filePath;
                $file->filesize = $fileSize;
                $file->save();
            }

            $place->name = $request->input('place_name');
            $place->description = $request->input('place_description');
            $place->latitude = $request->input('place_latitude');
            $place->longitude = $request->input('place_longitude');
            // $place->visibilities_id = $request->input('place_visibilities_id');
            // $place->visibilities_id = $request->input('place_visibility_id');
            $place->visibilities_id = $request->input('visibilities_id');
            $place->save();

            return redirect()->route('places.show', $place)
                ->with('success', __('Place successfully updated'));
        } else {
            // Manejar el fallo de almacenamiento local
            return redirect()->route("places.edit", $place)
                ->with('error', __('ERROR uploading file'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place, File $file)
    {
        $file=File::find($place->file_id);     
        if (\Storage::disk('public')->exists($file->filepath)) {
            Place::destroy($place->id);
            File::destroy($file->id);
            \Storage::disk('public')->delete($file->filepath);
            return redirect()->route('places.index', ["places" => Place::all()])
            ->with('success', 'Place successfully deleted');
        } else {
            return redirect()->route('places.show', $place)
            ->with('error', 'ERROR deleting file');
        }
    }
    public function favourite(Place $place){
        $favourite = Favorite::create([
            'user_id' => auth()->user()->id,
            'place_id' => $place->id,
        ]);
        return redirect()->route('places.show', $place);
    }

    public function unfavourite(Place $place){
        Favorite::where('user_id',auth()->user()->id)
                 ->where('place_id', $place->id )->delete();
        return redirect()->route('places.show', $place);
    }
}

