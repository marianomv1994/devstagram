<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        //return "Desde Imagen Controller";
        $imagen = $request->file('file');

        $nombreImagen = Str::uuid(). "." . $imagen->extension();

        $imagenservidor = Image::make($imagen);

        $imagenservidor->fit(1000,1000);

        $imagenPath = public_path('uploads'. '/'. $nombreImagen);

        $imagenservidor->save($imagenPath);

        return response()->json(['imagen'=> $nombreImagen]);

    }
}
