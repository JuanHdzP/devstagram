@extends('layouts.app')

@section('titulo')
    Iniciar Sesión
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-8 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login">
        </div>
        <div class="md:w-4/12 bg-slate-50 p-6 rounded-lg shadow-xl">
            <form action="{{ route('login') }}" method="post" autocomplete="off">
                @csrf

                @if (session('msg'))
                    <p class="font-semibold text-sm text-red-500 p-2">{{ session('msg') }}</p>
                @endif

                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Tu email de registro"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">

                    @error('email')
                        <p class="font-semibold text-sm text-red-500 p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password de registro"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="font-semibold text-sm text-red-500 p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember"><label class="text-sm text-gray-500 ml-1">Mantener sesión
                        abierta</label>
                </div>

                <input type="submit" value="Iniciar Sesión"
                    class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer p-3 uppercase font-bold w-full text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
