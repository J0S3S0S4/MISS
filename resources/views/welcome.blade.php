<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mis Salidas - Organiza con amigos</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white text-gray-900">
        <div class="relative min-h-screen">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-indigo-50 via-white to-white -z-10"></div>

            <nav class="max-w-7xl mx-auto px-6 py-10 flex justify-between items-center">
                <div class="text-2xl font-black tracking-tighter text-indigo-600">
                    MIS<span class="text-gray-900">SALIDAS</span>
                </div>
                
                @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-bold text-gray-600 hover:text-indigo-600 transition">Entrar al App</a>
                        @else
                            <a href="{{ route('login') }}" class="font-bold text-gray-600 hover:text-indigo-600 transition">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-gray-900 text-white font-bold rounded-2xl hover:bg-indigo-600 transition shadow-lg shadow-gray-200">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>

            <main class="max-w-7xl mx-auto px-6 pt-20 pb-32 text-center lg:text-left flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2 space-y-8">
                    <h1 class="text-6xl lg:text-7xl font-black text-gray-900 leading-[1.1] tracking-tight">
                        Organiza tus <span class="text-indigo-600">salidas</span> en segundos.
                    </h1>
                    <p class="text-xl text-gray-500 font-medium leading-relaxed max-w-xl">
                        La forma más fácil de armar el padel, el asado o la juntada con tus amigos. Todo en un solo lugar, con confirmaciones en tiempo real.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-indigo-600 text-white font-black rounded-[2rem] text-lg hover:bg-indigo-700 transition shadow-2xl shadow-indigo-200 text-center">
                            ¡Empezar ahora gratis!
                        </a>
                        <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">
                             ✨ Únete a tus amigos
                        </p>
                    </div>

                    <div class="pt-10 flex items-center gap-4 justify-center lg:justify-start">
                        <div class="flex -space-x-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 border-4 border-white"></div>
                            <div class="w-10 h-10 rounded-full bg-indigo-200 border-4 border-white"></div>
                            <div class="w-10 h-10 rounded-full bg-purple-200 border-4 border-white"></div>
                        </div>
                        <p class="text-sm font-bold text-gray-500">Más de 500 grupos ya lo usan</p>
                    </div>
                </div>

                <div class="lg:w-1/2 relative">
                    <div class="bg-gradient-to-br from-indigo-100 to-purple-100 w-full aspect-square rounded-[3rem] rotate-3 absolute inset-0 -z-10 shadow-inner"></div>
                    <div class="bg-white p-8 rounded-[3rem] shadow-2xl border border-gray-100 -rotate-3 transition-transform hover:rotate-0 duration-500">
                         <div class="space-y-6">
                             <div class="flex items-center justify-between">
                                 <div class="h-4 w-32 bg-gray-100 rounded-full"></div>
                                 <div class="h-4 w-12 bg-green-100 rounded-full"></div>
                             </div>
                             <div class="h-8 w-full bg-gray-50 rounded-xl"></div>
                             <div class="h-8 w-2/3 bg-gray-50 rounded-xl"></div>
                             <div class="pt-4 flex gap-2">
                                 <div class="h-10 w-10 rounded-full bg-indigo-500"></div>
                                 <div class="h-10 w-10 rounded-full bg-purple-500"></div>
                                 <div class="h-10 w-10 rounded-full bg-pink-500"></div>
                             </div>
                         </div>
                    </div>
                </div>
            </main>

            <footer class="py-10 text-center text-gray-400 font-bold text-xs uppercase tracking-widest border-t border-gray-50">
                &copy; {{ date('Y') }} Mis Salidas. Todos los derechos reservados.
            </footer>
        </div>
    </body>
</html>