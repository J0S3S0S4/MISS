<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-gray-900 leading-tight tracking-tight">
                    {{ __('Explorar Salidas') }}
                </h2>
                <p class="text-sm text-gray-500 font-medium">Descubre qué están planeando tus amigos</p>
            </div>
            
            <a href="{{ route('events.create') }}" class="group relative inline-flex items-center justify-center px-6 py-3 font-bold text-white transition-all duration-200 bg-indigo-600 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nueva Salida
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            @if (session('status'))
                <div class="animate-fade-in-down mb-8 p-4 bg-white border-l-4 border-indigo-500 shadow-sm rounded-xl flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 bg-indigo-50 rounded-full mr-3">
                            <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">{{ session('status') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($events as $event)
                    <div class="group bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col relative">
                        
                        <div class="h-2 w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                        <div class="p-8 flex-grow">
                            <div class="flex justify-between items-start mb-6">
                                <div class="p-3 bg-gray-50 rounded-2xl text-center min-w-[60px] border border-gray-100 group-hover:bg-indigo-50 transition-colors">
                                    <span class="block text-xs font-black text-indigo-600 uppercase">{{ $event->event_date->format('M') }}</span>
                                    <span class="block text-xl font-extrabold text-gray-800">{{ $event->event_date->format('d') }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1">Hora</span>
                                    <span class="text-sm font-black text-gray-700 bg-gray-100 px-3 py-1 rounded-lg">{{ $event->event_date->format('H:i') }} hs</span>
                                </div>
                            </div>
                            
                            <h3 class="text-xl font-black text-gray-900 mb-3 group-hover:text-indigo-600 transition-colors leading-tight">
                                {{ $event->title }}
                            </h3>
                            
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-2 italic">
                                "{{ $event->description }}"
                            </p>

                            <div class="space-y-4">
                                <div class="flex items-center p-3 bg-gray-50 rounded-xl border border-transparent group-hover:border-indigo-100 transition-all">
                                    <div class="text-xl mr-3">📍</div>
                                    <div class="overflow-hidden">
                                        <p class="text-[10px] uppercase font-bold text-gray-400 leading-none mb-1">Ubicación</p>
                                        <p class="text-sm font-bold text-gray-700 truncate">{{ $event->location ?? 'Por definir' }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center px-1">
                                    <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-xs font-bold text-indigo-700 border-2 border-white shadow-sm mr-3">
                                        {{ substr($event->creator->name, 0, 1) }}
                                    </div>
                                    <p class="text-sm text-gray-600 font-medium">Organizado por <span class="text-gray-900 font-bold">{{ $event->creator->name }}</span></p>
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-gray-50">
                                <div class="flex justify-between items-center mb-3">
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-tighter">¿Quiénes van?</p>
                                    <span class="text-[10px] font-bold px-2 py-0.5 bg-green-50 text-green-600 rounded-full">{{ $event->attendees->count() }} confirmados</span>
                                </div>
                                <div class="flex -space-x-3 overflow-hidden">
                                    @forelse($event->attendees->take(5) as $asistente)
                                        <div class="inline-block h-9 w-9 rounded-full ring-4 ring-white bg-gray-200 flex items-center justify-center text-[10px] font-bold text-gray-600 shadow-sm" title="{{ $asistente->name }}">
                                            {{ substr($asistente->name, 0, 1) }}
                                        </div>
                                    @empty
                                        <p class="text-xs text-gray-400 font-medium italic">Sé el primero en sumarte...</p>
                                    @endforelse
                                    @if($event->attendees->count() > 5)
                                        <div class="inline-block h-9 w-9 rounded-full ring-4 ring-white bg-indigo-600 flex items-center justify-center text-[10px] font-bold text-white shadow-sm">
                                            +{{ $event->attendees->count() - 5 }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="p-6 bg-gray-50/50 border-t border-gray-50 group-hover:bg-white transition-colors">
                            <livewire:confirm-attendance :event="$event" :key="'confirm-'.$event->id" />
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 bg-white rounded-[3rem] border-2 border-dashed border-gray-200 text-center shadow-inner">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-4xl animate-bounce">✨</span>
                        </div>
                        <h3 class="text-2xl font-black text-gray-800">Tu agenda está vacía</h3>
                        <p class="text-gray-500 max-w-xs mx-auto mt-2">No hay salidas programadas con tus amigos en este momento. ¡Propón algo divertido!</p>
                        <a href="{{ route('events.create') }}" class="mt-8 inline-block text-indigo-600 font-bold hover:underline">Crear el primer evento →</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-20">
                <div class="flex items-center gap-4 mb-8">
                    <div class="h-[1px] flex-grow bg-gray-200"></div>
                    <h3 class="text-sm font-black text-gray-400 uppercase tracking-[0.3em] flex items-center">
                        <span class="mr-2">🌍</span> Comunidad
                    </h3>
                    <div class="h-[1px] flex-grow bg-gray-200"></div>
                </div>
                
                <div class="max-w-4xl mx-auto bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                    <livewire:friends />
                </div>
            </div>

        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down { animation: fade-in-down 0.5s ease-out; }
    </style>
</x-app-layout>