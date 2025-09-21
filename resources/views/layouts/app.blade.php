<!DOCTYPE html>
<html lang="es" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Condo') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full">
    <div class="min-h-screen">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                <h1 class="text-lg font-semibold text-gray-900">@yield('title', 'Condo')</h1>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">Apartamento: {{ auth()->user()->apartamento }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:underline">Cerrar sesión</button>
                    </form>
                </div>
            </div>
        </header>

        <main>
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>
    @stack('scripts')
</body>
</html>