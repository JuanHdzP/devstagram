<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        // Redimensionar la imagen usando Intervention Image
        $manager = new ImageManager(Driver::class);
        $imagenServidor = $manager->read($imagen);
        $imagenServidor->cover(1000, 1000);

        // Guardar la imagen en la ruta especificada
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        // Devolver una respuesta JSON con el nombre de la imagen guardada
        return response()->json(['imagen' => $nombreImagen]);
    }
}
