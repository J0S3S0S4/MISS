<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Visitantes (Gente que no se ha registrado)
Route::view('/', 'welcome');

// 2. Usuarios Registrados (Todos tienen los mismos permisos)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Ver el listado de eventos (Dashboard)
    Route::get('/dashboard', [EventController::class, 'index'])->name('dashboard');
    
    // Perfil de usuario (Ajustado para corregir el error RouteNotFoundException)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile'); // Nombre principal que busca Breeze
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestión de Eventos (Cualquier usuario puede crear, editar o borrar)
    Route::resource('events', EventController::class)->names([
        'index'   => 'events.index',
        'create'  => 'events.create',
        'store'   => 'events.store',
        'edit'    => 'events.edit',
        'update'  => 'events.update',
        'destroy' => 'events.destroy',
    ]);
});

require __DIR__.'/auth.php';