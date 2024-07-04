<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        // Modificar request
        $request->request->add(['username' => Str::lower($request->username)]);

        // Validacion
        $this->validate($request, [
            'name' => 'required|max:25|min:3',
            'username' => 'required|max:25|min:3|unique:users',
            'email' => 'required|unique:users|email|max:50',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redireccionar
        return redirect()->route('post.index');
    }
}
