<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        // Modificar request
        $request->request->add(['username' => Str::lower($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'max:25', 'min:3', 'unique:users,username,' . auth()->user()->id, 'not_in:twitter,devstagram,editar-perfil'],
        ]);

        if ($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            // Redimensionar la imagen usando Intervention Image
            $manager = new ImageManager(Driver::class);
            $imagenServidor = $manager->read($imagen);
            $imagenServidor->cover(1000, 1000);

            // Guardar la imagen en la ruta especificada
            $imagenPath = public_path('profiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);

            // Eliminar imagen anterior
            if (auth()->user()->imagen) {
                $imagenPath = public_path('profiles/' . auth()->user()->imagen);
                if (File::exists($imagenPath)) {
                    unlink($imagenPath);
                }
            }
        }

        // Hacer cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? "";
        $usuario->save();

        // Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
