<div class="flex items-center justify-between w-full">
    <div class="flex items-center space-x-2">
        <span class="flex h-2 w-2 rounded-full bg-indigo-500"></span>
        <span class="text-xs font-bold text-gray-600 uppercase tracking-wider">
            {{ $attendeesCount }} confirmados
        </span>
    </div>
    
    @php
        // Usamos contains para chequear en la colección cargada, es más rápido que una consulta a DB aquí
        $isAttending = $event->attendees->contains(auth()->id());
    @endphp

    <button wire:click="toggleAttendance" 
        wire:loading.attr="disabled"
        @class([
            'inline-flex items-center px-4 py-2 border rounded-md font-bold text-[10px] uppercase tracking-widest transition ease-in-out duration-150 shadow-sm',
            'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' => !$isAttending,
            'bg-red-50 text-red-600 border-red-200 hover:bg-red-100' => $isAttending,
        ])>
        
        <span wire:loading.remove>
            {{ $isAttending ? '❌ Cancelar' : '✅ Confirmar' }}
        </span>
        
        <span wire:loading>
            Procesando...
        </span>
    </button>
</div>