<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'event_date', 
        'location', 
        'user_id'
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    // El usuario que organizó la salida
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Los usuarios que han confirmado que asistirán
    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_user')->withTimestamps();
    }
}