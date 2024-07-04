<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        // Validacion
        $this->validate($request, [
            'name' => 'required|max:25',
            'username' => 'required|max:25|min:3|unique:users',
            'email' => 'required|unique:users|email|max:50',
            'password' => 'required',
        ]);
    }
}
