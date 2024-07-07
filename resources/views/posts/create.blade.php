@extends('layouts.app')

@section('titulo')
    Crear nueva publicación
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data"
                class="dropzone w-full h-96 rounded flex flex-col justify-center items-center" id="my-dropzone">
                @csrf
            </form>
        </div>

        <div class="md:w-1/2 p-10 bg-slate-50 rounded-lg shadow-xl mt-10">
            <form action="{{ route('posts.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="titulo">Titulo</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Titulo de la publicación"
                        class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror"
                        value="{{ old('titulo') }}">
                    @error('titulo')
                        <p class="font-semibold text-sm text-red-500 p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" placeholder="Descripción de la publicación"
                        class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="font-semibold text-sm text-red-500 p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="hidden" name="imagen" value="{{ old('imagen') }}">
                    @error('imagen')
                        <p class="font-semibold text-sm text-red-500 p-2">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Crear publicación"
                    class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer p-3 uppercase font-bold w-full text-white rounded-lg">
            </form>
        </div>
    </div>

    <script>
        // Dropzone.options.myDropzone = {
        //     dictDefaultMessage: 'Sube aquí tu imagen...',
        //     acceptedFiles: '.png,.jpg,.jpeg,.gif',
        //     addRemoveLinks: true,
        //     dictRemoveFile: 'Borrar imagen',
        //     maxFiles: 1,
        //     uploadMultiple: false,
        // };

        Dropzone.autoDiscover = false;
        let dropzone = new Dropzone("#my-dropzone", {
            dictDefaultMessage: 'Sube aquí tu imagen...',
            acceptedFiles: '.png,.jpg,.jpeg,.gif',
            addRemoveLinks: true,
            dictRemoveFile: 'Borrar imagen',
            maxFiles: 1,
            uploadMultiple: false,

            init: function() {
                if (document.querySelector('[name="imagen"]').value.trim()) {
                    const imagenPublicada = {};
                    imagenPublicada.size = 1234;
                    imagenPublicada.name = document.querySelector('[name="imagen"]').value;

                    this.options.addedfile.call(this, imagenPublicada);
                    this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

                    imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete')
                }
            }
        });

        dropzone.on('success', function(file, response) {
            document.querySelector('[name="imagen"]').value = response.imagen;
        })
        dropzone.on('removedfile', function() {
            document.querySelector('[name="imagen"]').value = "";
        })
    </script>

    <style>
        .dropzone {
            background: none !important;
            border: dashed;
            border-color: rgba(173, 163, 163, 0.945);
        }
    </style>
@endsection
