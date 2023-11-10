<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\File;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("places.index", [
            "places" => Place::all(),
            "files" => File::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("places.create");
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
                'author_id' =>auth()->user()->id,
            ]);
            \Log::debug("DB storage OK");
            return redirect()->route('places.show', $place)
                ->with('success', 'Place successfully saved');
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("places.create")
                ->with('error', 'ERROR uploading file');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        // return view("places.show", [
        //     "places" => Place::all(),
        //     "files" => File::all()
        // ]);
        $file=File::find($place->file_id);
        return view("places.show", [
            "place" => $place,
            "file" => $file,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        //
        return view("places.edit", ["place" => $place]);
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
            $place->save();

            return redirect()->route('places.show', $place)
                ->with('success', 'Place successfully updated');
        } else {
            // Manejar el fallo de almacenamiento local
            return redirect()->route("places.edit", $place)
                ->with('error', 'ERROR uploading file');
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
}

