<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Eventos que este usuario ha creado (como organizador)
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    // Eventos a los que este usuario ha confirmado asistencia
    public function attendedEvents()
    {
        return $this->belongsToMany(Event::class, 'event_user')->withTimestamps();
    }

    // Verificar si el usuario es administrador
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // RELACIONES DE AMISTAD
    
    // Amigos aceptados (relación recíproca)
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
                    ->wherePivot('status', 'accepted')
                    ->withPivot('status');
    }

    // Solicitudes que otros me enviaron y están esperando mi respuesta
    public function pendingFriendRequests()
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id')
                    ->wherePivot('status', 'pending');
    }

    // Método rápido para saber si soy amigo de alguien en las vistas
    public function isFriendWith($userId): bool
    {
        return $this->friends()->where('friend_id', $userId)->exists();
    }
}