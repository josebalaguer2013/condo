{{-- resources/views/propietario/perfil/edit.blade.php --}}
<x-layouts.app :title="__('Mi Perfil')">
<div class="max-w-5xl mx-auto p-6 bg-gradient-to-br from-blue-50 via-white to-red-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 rounded-2xl shadow-2xl mt-6 border border-dashed border-blue-300 dark:border-gray-700">

    {{-- TÍTULO + BOTÓN REGRESO --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-red-600 dark:from-blue-400 dark:to-red-400">
            🇻🇪 Mi Perfil
        </h1>
        <a href="{{ route('propietario.dashboard') }}"
           class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 text-gray-900 dark:text-gray-100 rounded-lg hover:scale-105 transition transform shadow">
            ⬅ Volver al Dashboard
        </a>
    </div>

    {{-- Mensaje flash --}}
    @if(session('success'))
        <div class="mb-6 bg-gradient-to-r from-green-100 to-green-200 dark:from-green-900 dark:to-green-800 text-green-800 dark:text-green-200 border-l-4 border-green-500 px-4 py-3 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- TARJETA DE FORMULARIO --}}
    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-lg p-8 ring-2 ring-blue-200 dark:ring-gray-700">

        <form method="POST" action="{{ route('perfil.update') }}">
            @csrf

            {{-- GRID 2 COLUMNAS --}}
            <div class="grid md:grid-cols-2 gap-6">

                {{-- SEXO --}}
                <div>
                    <label class="block text-sm font-bold text-blue-700 dark:text-blue-300">Sexo</label>
                    <select name="sexo" class="mt-1 w-full rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                        <option value="">Seleccione</option>
                        <option value="Masculino" @selected(old('sexo', auth()->user()->sexo) == 'Masculino')>Masculino</option>
                        <option value="Femenino"  @selected(old('sexo', auth()->user()->sexo) == 'Femenino')>Femenino</option>
                    </select>
                </div>

                {{-- FECHA NACIMIENTO --}}
                <div>
                    <label class="block text-sm font-bold text-blue-700 dark:text-blue-300">Fecha de nacimiento</label>
                    <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', optional(auth()->user()->fecha_nacimiento)->format('Y-m-d')) }}" class="mt-1 w-full rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                </div>

                {{-- ESTADO CIVIL --}}
                <div>
                    <label class="block text-sm font-bold text-blue-700 dark:text-blue-300">Estado civil</label>
                    <select name="estado_civil" class="mt-1 w-full rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                        <option value="">Seleccione</option>
                        <option value="Soltero/a"   @selected(old('estado_civil', auth()->user()->estado_civil) == 'Soltero/a')>Soltero/a</option>
                        <option value="Casado/a"    @selected(old('estado_civil', auth()->user()->estado_civil) == 'Casado/a')>Casado/a</option>
                        <option value="Viudo/a"     @selected(old('estado_civil', auth()->user()->estado_civil) == 'Viudo/a')>Viudo/a</option>
                        <option value="Divorciado/a" @selected(old('estado_civil', auth()->user()->estado_civil) == 'Divorciado/a')>Divorciado/a</option>
                    </select>
                </div>

                {{-- NIVEL INSTRUCCIÓN --}}
                <div>
                    <label class="block text-sm font-bold text-blue-700 dark:text-blue-300">Nivel de instrucción</label>
                    <select name="nivel_instruccion" class="mt-1 w-full rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                        <option value="">Seleccione</option>
                        <option value="Primaria" @selected(old('nivel_instruccion', auth()->user()->nivel_instruccion) == 'Primaria')>Primaria</option>
                        <option value="Secundaria" @selected(old('nivel_instruccion', auth()->user()->nivel_instruccion) == 'Secundaria')>Secundaria</option>
                        <option value="Técnico" @selected(old('nivel_instruccion', auth()->user()->nivel_instruccion) == 'Técnico')>Técnico</option>
                        <option value="Universitario" @selected(old('nivel_instruccion', auth()->user()->nivel_instruccion) == 'Universitario')>Universitario</option>
                        <option value="Postgrado" @selected(old('nivel_instruccion', auth()->user()->nivel_instruccion) == 'Postgrado')>Postgrado</option>
                    </select>
                </div>

                {{-- CARGA FAMILIAR --}}
                <div>
                    <label class="block text-sm font-bold text-blue-700 dark:text-blue-300">Número de cargas familiares</label>
                    <input type="number" min="0" name="carga_familiar" value="{{ old('carga_familiar', auth()->user()->carga_familiar) }}" class="mt-1 w-full rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                </div>

                {{-- PROFESIÓN --}}
                <div>
                    <label class="block text-sm font-bold text-blue-700 dark:text-blue-300">Profesión</label>
                    <input type="text" name="profesion" value="{{ old('profesion', auth()->user()->profesion) }}" class="mt-1 w-full rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow" placeholder="Ej: Ingeniero">
                </div>

                {{-- LUGAR DONDE LABORA --}}
                <div>
                    <label class="block text-sm font-bold text-blue-700 dark:text-blue-300">Lugar donde labora</label>
                    <input type="text" name="lugar_labora" value="{{ old('lugar_labora', auth()->user()->lugar_labora) }}" class="mt-1 w-full rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow" placeholder="Empresa / Institución">
                </div>

                {{-- CONDICIÓN LABORAL --}}
                <div>
                    <label class="block text-sm font-bold text-blue-700 dark:text-blue-300">Condición laboral</label>
                    <select name="condicion_laboral" class="mt-1 w-full rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                        <option value="">Seleccione</option>
                        <option value="Dependiente"  @selected(old('condicion_laboral', auth()->user()->condicion_laboral) == 'Dependiente')>Dependiente</option>
                        <option value="Independiente" @selected(old('condicion_laboral', auth()->user()->condicion_laboral) == 'Independiente')>Independiente</option>
                        <option value="Desempleado"  @selected(old('condicion_laboral', auth()->user()->condicion_laboral) == 'Desempleado')>Desempleado</option>
                    </select>
                </div>

                {{-- ESTATUS LABORAL --}}
                <div>
                    <label class="block text-sm font-bold text-blue-700 dark:text-blue-300">Estatus laboral</label>
                    <select name="estatus_laboral" class="mt-1 w-full rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                        <option value="">Seleccione</option>
                        <option value="Activo" @selected(old('estatus_laboral', auth()->user()->estatus_laboral) == 'Activo')>Activo</option>
                        <option value="Pasivo" @selected(old('estatus_laboral', auth()->user()->estatus_laboral) == 'Pasivo')>Pasivo</option>
                    </select>
                </div>

                {{-- CENTRO DE VOTACIÓN --}}
                <div>
                    <label class="block text-sm font-bold text-blue-700 dark:text-blue-300">Centro de votación (opcional)</label>
                    <input type="text" name="centro_votacion" value="{{ old('centro_votacion', auth()->user()->centro_votacion) }}" class="mt-1 w-full rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow" placeholder="Nombre del centro">
                </div>

                {{-- DISCAPACIDAD --}}
                <div>
                    <label class="block text-sm font-bold text-blue-700 dark:text-blue-300">¿Tiene discapacidad?</label>
                    <select name="tiene_discapacidad" class="mt-1 w-full rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                        <option value="0" @selected(!auth()->user()->tiene_discapacidad)>No</option>
                        <option value="1" @selected(auth()->user()->tiene_discapacidad)>Sí</option>
                    </select>
                </div>

                {{-- CONDICIÓN DE SALUD --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-blue-700 dark:text-blue-300">Condición de salud (opcional)</label>
                    <textarea name="condicion_salud" rows="3" class="mt-1 w-full rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow" placeholder="Descripción breve">{{ old('condicion_salud', auth()->user()->condicion_salud) }}</textarea>
                </div>
            </div>

            {{-- BOTÓN GUARDAR --}}
            <div class="flex items-center justify-between mt-8">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition transform hover:scale-105 shadow-lg">
                    Guardar Perfil
                </button>
                <a href="{{ route('propietario.dashboard') }}" class="px-4 py-2 bg-gradient-to-r from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-700 text-gray-900 dark:text-gray-100 rounded-lg hover:scale-105 transition shadow">
                    Volver
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Alpine.js CDN --}}
@push('scripts')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
</x-layouts.app>