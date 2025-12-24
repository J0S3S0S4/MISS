<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="flex flex-col items-end space-y-4 mt-4">
            <div class="flex items-center justify-between w-full">
                <div class="text-sm">
                    <span class="text-gray-600">¿No tienes perfil?</span>
                    <a class="underline font-medium text-indigo-600 hover:text-indigo-900" href="{{ route('register') }}" wire:navigate>
                        {{ __('Crea uno aquí') }}
                    </a>
                </div>
                <x-primary-button class="ms-3">{{ __('Entrar') }}</x-primary-button>
            </div>

            @if (Route::has('password.request'))
                <a class="underline text-xs text-gray-500 hover:text-gray-800" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif
        </div>
    </form>
</div>