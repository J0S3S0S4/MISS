<nav class="flex flex-1 justify-end items-center gap-4">
    @auth
        <a href="{{ url('/dashboard') }}" 
           class="text-sm font-bold text-gray-700 hover:text-indigo-600 transition-colors uppercase tracking-widest">
            Entrar al App →
        </a>
    @else
        <a href="{{ route('login') }}" 
           class="text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            Iniciar Sesión
        </a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" 
               class="ml-4 inline-flex items-center px-6 py-2.5 bg-indigo-600 text-white text-sm font-black rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 transform hover:-translate-y-0.5">
                Crear Cuenta
            </a>
        @endif
    @endauth
</nav>