<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // 1. Importamos la interfaz
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Event;
use App\Models\User;

class UserConfirmedAttendance extends Notification implements ShouldQueue // 2. Implementamos ShouldQueue
{
    use Queueable;

    public function __construct(public Event $event, public User $user) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('¡Nueva confirmación de asistencia!')
            ->greeting('¡Hola, ' . $notifiable->name . '!')
            ->line('Tu amigo ' . $this->user->name . ' ha confirmado que irá a: ' . $this->event->title)
            ->action('Ver evento', url('/dashboard'))
            ->line('¡Prepárate para la salida!')
            ->salutation('Saludos, el equipo de Mis Salidas'); // Despedida opcional
    }

    /**
     * Opcional: Definir cuántas veces reintentar si Mailtrap falla (error 550)
     */
    public $tries = 3;

    /**
     * Opcional: Cuánto esperar entre reintentos (en segundos)
     */
    public $backoff = 10;
}