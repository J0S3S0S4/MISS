<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-extrabold text-2xl text-gray-900 leading-tight tracking-tight">
                {{ __('Ajustes de Perfil') }}
            </h2>
            <p class="text-sm text-gray-500 font-medium">Gestiona tu identidad y seguridad en Mis Salidas</p>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="p-8 sm:p-12 bg-white shadow-sm border border-gray-100 sm:rounded-[2.5rem] relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-indigo-500"></div>
                <div class="max-w-xl">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                        <span class="mr-2">👤</span> Datos Personales
                    </h3>
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="p-8 sm:p-12 bg-white shadow-sm border border-gray-100 sm:rounded-[2.5rem] relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-purple-500"></div>
                <div class="max-w-xl">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                        <span class="mr-2">🔒</span> Seguridad de la Cuenta
                    </h3>
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="p-8 sm:p-12 bg-red-50/30 border border-red-100 sm:rounded-[2.5rem] relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-red-500"></div>
                <div class="max-w-xl">
                    <h3 class="text-lg font-bold text-red-800 mb-6 flex items-center">
                        <span class="mr-2">⚠️</span> Zona de Peligro
                    </h3>
                    <livewire:profile.delete-user-form />
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>