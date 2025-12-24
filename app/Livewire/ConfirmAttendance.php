<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;
use App\Notifications\UserConfirmedAttendance;
use Illuminate\Support\Facades\Auth;

class ConfirmAttendance extends Component
{
    public Event $event;
    public $attendeesCount;

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->attendeesCount = $event->attendees()->count();
    }

    public function getListeners()
    {
        return [
            "echo:events.{$this->event->id},AttendanceUpdated" => 'refreshAttendance',
        ];
    }

    public function toggleAttendance()
    {
        $user = Auth::user();
        
        // El método toggle añade si no está, y quita si está
        $this->event->attendees()->toggle($user->id);
        
        // Actualizamos contador local
        $this->refreshAttendance();

        // Notificar al organizador SOLO si el usuario acaba de confirmar
        $isAttending = $this->event->attendees()->where('user_id', $user->id)->exists();
        
        if ($isAttending) {
            $this->event->creator->notify(new UserConfirmedAttendance($this->event, $user));
        }

        // Lanzar el evento a los demás para actualizar contador Y lista de nombres
        broadcast(new \App\Events\AttendanceUpdated($this->event->id))->toOthers();
        
        // Opcional: Esto refresca la página actual para ver cambios en la lista de nombres propia
        $this->dispatch('refresh-dashboard'); 
    }

    public function refreshAttendance()
    {
        // Forzamos la recarga de la relación para que cuente bien
        $this->event->load('attendees');
        $this->attendeesCount = $this->event->attendees->count();
    }

    public function render()
    {
        return view('livewire.confirm-attendance');
    }
}