<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Notifications\NewEventCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class EventController extends Controller
{
    public function index()
{
    // Obtenemos los IDs de mis amigos y le sumamos mi propio ID
    $idsInvolucrados = auth()->user()->friends()->pluck('users.id')->push(auth()->id());

    // Solo mostramos eventos donde el creador sea yo o un amigo
    $events = Event::with('creator', 'attendees')
        ->whereIn('user_id', $idsInvolucrados)
        ->latest()
        ->get();

    return view('dashboard', compact('events'));
}

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
        ]);

        // Creamos el evento
        $event = auth()->user()->events()->create($validated);

        // --- LÓGICA DE NOTIFICACIÓN ---
        // Obtenemos solo a los amigos del admin que creó el evento
        $amigos = auth()->user()->friends;

        if ($amigos->count() > 0) {
            Notification::send($amigos, new NewEventCreated($event));
        }

        return redirect()->route('dashboard')->with('status', '¡Salida creada y notificada a tus amigos!');
    }
}