@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('perfil.store') }}" method="post" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Tu nobre de usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="font-semibold text-sm text-red-500 p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="imagen">Imagen perfil</label>
                    <input type="file" name="imagen" id="imagen" class="border p-3 w-full rounded-lg" value=""
                        accept=".jpg, .jpeg, .png, .gif">
                </div>

                <input type="submit" value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer p-3 uppercase font-bold w-full text-white rounded-lg">
            </form>
        </div>



    </div>
@endsection
