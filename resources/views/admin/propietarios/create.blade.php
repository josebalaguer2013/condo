{{-- Vista: admin.propietarios.create --}}
{{-- Propósito: Formulario para dar de alta 1 propietario con cédula y apartamento --}}

<x-layouts.app>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Alta de Propietario</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-6 p-6 bg-white rounded shadow">
        {{-- Mensaje flash --}}
        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.propietarios.store') }}">
            @csrf

            {{-- Apartamento (select con tu lista exacta) --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Apartamento</label>
                <select name="apartamento" required class="w-full border-gray-300 rounded">
                    <option value="">Seleccione...</option>
                    @foreach([
                        'PB-01','PB-02','PB-03','PB-04','PB-05','PB-06','PB-07',
                        'B1-01','B1-02','B1-03','B1-04','B1-05','B1-06','B1-07','B1-08','B1-09','B1-10',
                        'B1-11','B1-12','B1-13','B1-14','B1-15','B1-16','B1-17','B1-18','B1-19','B1-20',
                        'B2-01','B2-02','B2-03','B2-04','B2-05','B2-06','B2-07','B2-08','B2-09','B2-10',
                        'B2-11','B2-12','B2-13','B2-14','B2-15','B2-16','B2-17','B2-18','B2-19','B2-20',
                        'B3-01','B3-02','B3-03','B3-04','B3-05','B3-06','B3-07','B3-08','B3-09','B3-10',
                        'B3-11','B3-12','B3-13','B3-14','B3-15','B3-16','B3-17','B3-18','B3-19','B3-20',
                        'B4-01','B4-02','B4-03','B4-04','B4-05','B4-06','B4-07','B4-08','B4-09','B4-10',
                        'B4-11','B4-12','B4-13','B4-14','B4-15','B4-16','B4-17','B4-18','B4-19','B4-20',
                        'B5-01','B5-02','B5-03','B5-04','B5-05','B5-06','B5-07','B5-08','B5-09','B5-10',
                        'B5-11','B5-12','B5-13','B5-14','B5-15','B5-16','B5-17','B5-18','B5-19','B5-20',
                        'B6-01','B6-02','B6-03','B6-04','B6-05','B6-06','B6-07','B6-08','B6-09','B6-10',
                        'B6-11','B6-12','B6-13','B6-14','B6-15','B6-16','B6-17','B6-18','B6-19','B6-20',
                        'B7-01','B7-02','B7-03','B7-04','B7-05','B7-06','B7-07','B7-08','B7-09','B7-10',
                        'B7-11','B7-12','B7-13','B7-14','B7-15','B7-16','B7-17','B7-18','B7-19','B7-20'
                    ] as $apto)
                        <option value="{{ $apto }}">{{ $apto }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Cédula / DNI --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Cédula / DNI</label>
                <input type="text" name="dni" required
                       class="w-full border-gray-300 rounded"
                       placeholder="Ej: 12345678">
            </div>

            {{-- Clave temporal (solo lectura) --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Contraseña temporal</label>
                <input type="text" readonly value="usuario123"
                       class="w-full bg-gray-100 border-gray-300 rounded">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Guardar Propietario
            </button>
        </form>
    </div>
</x-layouts.app>