<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="p-2 bg-white rounded-full shadow-sm hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h2 class="font-extrabold text-2xl text-gray-900 leading-tight tracking-tight">
                {{ __('Nueva Salida') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-[2.5rem] border border-gray-100">
                
                <div class="h-3 w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                <div class="p-8 md:p-12">
                    <div class="mb-10">
                        <h3 class="text-xl font-black text-gray-800">¿Qué tienes en mente?</h3>
                        <p class="text-sm text-gray-500">Tus amigos recibirán una notificación por correo al publicar.</p>
                    </div>

                    <form action="{{ route('events.store') }}" method="POST" class="space-y-8">
                        @csrf
                        
                        <div class="relative">
                            <x-input-label for="title" value="¿Cómo se llama la salida?" class="text-xs font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-xl">🎉</span>
                                <x-text-input id="title" name="title" type="text" 
                                    class="block w-full pl-12 pr-4 py-4 bg-gray-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 rounded-2xl transition-all font-bold text-gray-800 placeholder:font-normal" 
                                    placeholder="Ej: Padel y Cervezas, Asado en lo de Juan..." 
                                    required />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="description" value="Detalles importantes" class="text-xs font-black uppercase tracking-widest text-indigo-600 mb-2" />
                            <textarea id="description" name="description" 
                                class="mt-1 block w-full bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 rounded-2xl shadow-sm py-4 px-5 text-gray-700 font-medium" 
                                rows="4" 
                                placeholder="Escribe aquí lo que necesiten saber (qué llevar, presupuesto, etc.)"
                                required></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <x-input-label for="event_date" value="¿Cuándo será?" class="text-xs font-black uppercase tracking-widest text-indigo-600 mb-2" />
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center">📅</span>
                                    <x-text-input id="event_date" name="event_date" type="datetime-local" 
                                        class="block w-full pl-12 py-4 bg-gray-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 rounded-2xl font-bold text-gray-700" 
                                        required />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="location" value="¿Dónde nos vemos?" class="text-xs font-black uppercase tracking-widest text-indigo-600 mb-2" />
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center">📍</span>
                                    <x-text-input id="location" name="location" type="text" 
                                        class="block w-full pl-12 py-4 bg-gray-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 rounded-2xl font-bold text-gray-700" 
                                        placeholder="Ej: Club de Padel, Mi casa..." />
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 flex flex-col md:flex-row items-center gap-4">
                            <button type="submit" class="w-full md:w-auto flex-grow px-8 py-4 bg-gray-900 hover:bg-indigo-600 text-white font-black rounded-2xl shadow-lg shadow-gray-200 transition-all duration-300 transform hover:-translate-y-1">
                                🚀 Publicar e Invitar Amigos
                            </button>
                            
                            <a href="{{ route('dashboard') }}" class="w-full md:w-auto text-center px-8 py-4 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <p class="mt-8 text-center text-xs text-gray-400 font-medium">
                Al publicar, se enviará un correo automáticamente a todos tus amigos conectados.
            </p>
        </div>
    </div>
</x-app-layout>