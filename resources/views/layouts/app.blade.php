<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DevStagram - @yield('titulo')</title>
    @vite('resources/css/app.css')
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    @stack('styles')
    @stack('scripts')

</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/">
                <h1 class="text-3xl font-black">
                    DevStagram
                </h1>
            </a>

            @auth
                <nav class="flex gap-2 items-center">
                    <a href="{{ route('posts.create') }}"
                        class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        Crear
                    </a>
                    <a href="{{ route('posts.index', auth()->user()->username) }}"
                        class="font-bold text-gray-600 text-sm">HOLA:
                        <span class="font-normal">{{ auth()->user()->username }}</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm">Cerrar Sesión</button>
                    </form>
                </nav>
            @endauth

            @guest
                <nav class="flex gap-2 items-center">
                    <a href="{{ route('login') }}" class="font-bold uppercase text-gray-600 text-sm">Login</a>
                    <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600 text-sm">Crear Cuenta</a>
                </nav>
            @endguest
        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>
        @yield('contenido')
    </main>

    <footer class="text-center p-5 text-gray-500 font-bold mt-10">
        DevStagram - Todos los derecho reservados {{ now()->year }}
        {{-- @php echo date('Y') @endphp --}}
    </footer>
</body>

</html>
