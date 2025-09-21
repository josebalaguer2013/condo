{{-- resources/views/propietario/dashboard.blade.php --}}
<x-layouts.app :title="__('Dashboard Propietario')">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
            Bienvenido, Propietario
        </h1>

        <div class="grid gap-6 md:grid-cols-3">
            {{-- Completar Perfil --}}
            <a href="{{ route('perfil.edit') }}"
               class="block p-4 bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-xl hover:bg-neutral-50 dark:hover:bg-neutral-800 transition">
                <div class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">✏️ Completar Perfil</div>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">Actualiza tus datos personales</p>
            </a>

            {{-- Agregar Familiares --}}
            <a href="{{ route('integrantes.index') }}"
               class="block p-4 bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-xl hover:bg-neutral-50 dark:hover:bg-neutral-800 transition">
                <div class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">👨‍👩‍👧‍👦 Agregar Familiares</div>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">Registra a tus integrantes</p>
            </a>

            {{-- Mi Apartamento --}}
            <div class="block p-4 bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-xl">
                <div class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">🏠 Mi Apartamento</div>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ auth()->user()->apartamento }}</p>
            </div>
        </div>
    </div>
</x-layouts.app>