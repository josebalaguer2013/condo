@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Usuarios y Perfiles</h1>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2">Apartamento</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Cédula</th>
                    <th class="px-4 py-2">Profesión</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $u)
                <tr class="border-b dark:border-gray-600">
                    <td class="px-4 py-2">{{ $u->apartamento }}</td>
                    <td class="px-4 py-2">{{ $u->name }} {{ $u->apellido }}</td>
                    <td class="px-4 py-2">{{ $u->dni }}</td>
                    <td class="px-4 py-2">{{ optional($u->perfil)->profesion ?? '—' }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('admin.usuarios-perfiles.edit', $u) }}" class="text-blue-600 hover:underline">Editar</a>
                        <form action="{{ route('admin.usuarios-perfiles.destroy', $u) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar usuario y perfil?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $usuarios->links() }}
    </div>
</div>
@endsection