<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Mis Salidas') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,900&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Cambiamos min-height para evitar cortes en móviles */
            .animated-gradient {
                background: linear-gradient(-45deg, #6366f1, #a855f7, #ec4899, #22d3ee);
                background-size: 400% 400%;
                animation: gradient 15s ease infinite;
                min-height: 100vh; 
            }

            @keyframes gradient {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
        </style>
    </head>

    <body class="animated-gradient font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center p-4">
            
            <div class="mb-6 inline-flex items-center justify-center p-5 bg-white/20 backdrop-blur-xl rounded-[2rem] shadow-xl border border-white/30">
                <a href="/" wire:navigate class="transition hover:opacity-80">
                    <x-application-logo />
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-10 bg-white/95 backdrop-blur-md shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] overflow-hidden rounded-[2.5rem]">
                {{ $slot }}
            </div>

            <p class="mt-6 text-white/60 text-xs font-medium uppercase tracking-widest">
                &copy; {{ date('Y') }} MISS - Mis Salidas
            </p>
        </div>
    </body>
</html>