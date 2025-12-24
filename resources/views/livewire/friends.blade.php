<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $search = '';

    // Buscar usuarios que no sean yo mismo
    public function with(): array
    {
        return [
            'users' => User::where('id', '!=', auth()->id())
                ->where('name', 'like', '%' . $this->search . '%')
                ->paginate(10),
        ];
    }

    // Enviar solicitud de amistad
    public function sendRequest($friendId)
    {
        $exists = DB::table('friendships')
            ->where('user_id', auth()->id())
            ->where('friend_id', $friendId)
            ->exists();

        if (!$exists) {
            auth()->user()->friends()->attach($friendId, ['status' => 'pending']);
            session()->flash('message', 'Solicitud enviada.');
        }
    }

    // Aceptar solicitud
    public function acceptRequest($senderId)
    {
        DB::table('friendships')
            ->where('user_id', $senderId)
            ->where('friend_id', auth()->id())
            ->update(['status' => 'accepted']);
        
        // Amistad recíproca automática
        auth()->user()->friends()->attach($senderId, ['status' => 'accepted']);
        
        session()->flash('message', '¡Ahora son amigos!');
    }
}; ?>

<div class="p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Gestión de Amigos</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg border border-green-200">
            {{ session('message') }}
        </div>
    @endif

    @if(auth()->user()->pendingFriendRequests->count() > 0)
        <div class="mb-8">
            <h3 class="text-sm font-bold text-orange-600 uppercase mb-3">Solicitudes recibidas</h3>
            <div class="space-y-2">
                @foreach(auth()->user()->pendingFriendRequests as $request)
                    <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg border border-orange-100">
                        <span class="font-medium text-gray-700">{{ $request->name }}</span>
                        <button wire:click="acceptRequest({{ $request->id }})" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm transition">
                            Aceptar
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="mb-6">
        <input wire:model.live="search" type="text" placeholder="Buscar amigos por nombre..." 
               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    <div class="grid grid-cols-1 gap-4">
        @forelse($users as $user)
            <div class="flex items-center justify-between p-4 border rounded-xl hover:bg-gray-50 transition">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center font-bold mr-3">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>

                @php
                    $friendship = DB::table('friendships')
                        ->where('user_id', auth()->id())
                        ->where('friend_id', $user->id)
                        ->first();
                @endphp

                @if(!$friendship)
                    <button wire:click="sendRequest({{ $user->id }})" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                        Agregar
                    </button>
                @elseif($friendship->status === 'pending')
                    <span class="text-xs font-bold text-gray-400 bg-gray-100 px-3 py-1 rounded-full uppercase">Pendiente</span>
                @else
                    <span class="text-xs font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full uppercase">Amigos</span>
                @endif
            </div>
        @empty
            <p class="text-center text-gray-500 py-4">No se encontraron usuarios.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>