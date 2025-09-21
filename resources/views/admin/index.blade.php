{{-- resources/views/admin/index.blade.php --}}
<!DOCTYPE html>
<html lang="es" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Administrador</title>
@vite(['resources/css/app.css'])
    <style>
        /* personalización rápida */
        .sidebar{ min-width: 250px; max-width: 250px; background:#1e293b; color:#cbd5e1; }
        .sidebar a{ display:block; padding:.75rem 1.25rem; border-radius:.375rem; margin:.25rem 0; }
        .sidebar a:hover{ background:#334155; color:#fff; }
        .content{ flex:1; background:#f1f5f9; }
        @media(max-width:768px){ .sidebar{ display:none; } }
    </style>
</head>
<body class="h-full">
    <div class="d-flex h-100">
        {{-- Menú lateral --}}
        <nav class="sidebar p-3">
            <h5 class="mb-3 text-white">Administración</h5>
            <a href="{{ route('admin.propietarios.create') }}">
                ➕ Agregar Apartamento
            </a>
            {{-- puedes agregar más enlaces aquí --}}
        </nav>

        {{-- Área de contenido --}}
        <main class="content p-4">
            @yield('adminContent')
        </main>
    </div>
</body>
</html>