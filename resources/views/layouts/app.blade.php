<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        <title>Devstagram | @yield('titulo')</title>
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }} " defer></script> --}}
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js" defer></script>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

        @livewireStyles
    </head>

    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <a
                    href="{{ route('home') }}"
                    class="text-3xl font-black">
                    DevStagram
                </a>

                @auth
                    <nav class="flex gap-2 items-center">
                        <a
                            class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer"
                            href="{{ route('posts.create') }}"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                            </svg>

                            Crear
                        </a>
                        <a
                            class="font-bold text-gray-600 text-sm"
                            href="{{ route('posts.index', auth()->user()->username) }}">
                                Hola: <span class="font-normal"> {{ auth()->user()->username }}</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="font-bold uppercase text-gray-600 text-sm">
                                Cerrar sesión
                            </button>
                        </form>
                    </nav>
                @endauth

                @guest
                    <nav class="flex gap-2 items-center">
                        <a 
                            class="font-bold uppercase text-gray-600 text-sm"
                            href="{{ route('login') }}">
                                Login
                        </a>
                        <a 
                            class="font-bold uppercase text-gray-600 text-sm"
                            href="{{ route('register') }}"
                        >
                                Crear cuenta
                        </a>
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

        <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
            DevStagram - Todos los derechos reservados {{ now()->format('d F Y') }}
            <br>
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
        @livewireScripts
    </body>
</html>