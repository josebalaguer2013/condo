@extends('layouts.app')   {{-- o tu layout actual --}}

@section('content')
<div class="max-w-4xl mx-auto p-4 bg-white rounded-xl shadow mt-4">
    <h2 class="text-xl font-semibold mb-4">Mi Perfil</h2>

    {{-- Botón desplegable --}}
    <div x-data="{ open: false }">
        <button @click="open = !open"
                class="mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Presione para llenar datos adicionales
        </button>

        {{-- Formulario colapsable --}}
        <div x-show="open" x-transition class="border border-neutral-200 rounded-lg p-4">

            <form method="POST" action="{{ route('perfil.update') }}">
                @csrf

                {{-- SEXO --}}
                <label class="block text-sm font-medium text-gray-700 mt-3">Sexo</label>
                <select name="sexo" class="form-select w-full">
                    <option value="">Seleccione</option>
                    <option value="Masculino" @selected(old('sexo', auth()->user()->sexo) == 'Masculino')>Masculino</option>
                    <option value="Femenino"  @selected(old('sexo', auth()->user()->sexo) == 'Femenino')>Femenino</option>
                </select>

                {{-- FECHA NACIMIENTO --}}
                <label class="block text-sm font-medium text-gray-700 mt-3">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', auth()->user()->fecha_nacimiento?->format('Y-m-d')) }}" class="form-control w-full">

                {{-- ESTADO CIVIL --}}
                <label class="block text-sm font-medium text-gray-700 mt-3">Estado civil</label>
                <select name="estado_civil" class="form-select w-full">
                    <option value="">Seleccione</option>
                    <option value="Soltero/a"   @selected(old('estado_civil', auth()->user()->estado_civil) == 'Soltero/a')>Soltero/a</option>
                    <option value="Casado/a"    @selected(old('estado_civil', auth()->user()->estado_civil) == 'Casado/a')>Casado/a</option>
                    <option value="Viudo/a"     @selected(old('estado_civil', auth()->user()->estado_civil) == 'Viudo/a')>Viudo/a</option>
                    <option value="Divorciado/a" @selected(old('estado_civil', auth()->user()->estado_civil) == 'Divorciado/a')>Divorciado/a</option>
                </select>

                {{-- NIVEL INSTRUCCIÓN --}}
                <label class="block text-sm font-medium text-gray-700 mt-3">Nivel de instrucción</label>
                <select name="nivel_instruccion" class="form-select w-full">
                    <option value="">Seleccione</option>
                    <option value="Primaria" @selected(old('nivel_instruccion', auth()->user()->nivel_instruccion) == 'Primaria')>Primaria</option>
                    <option value="Secundaria" @selected(old('nivel_instruccion', auth()->user()->nivel_instruccion) == 'Secundaria')>Secundaria</option>
                    <option value="Técnico" @selected(old('nivel_instruccion', auth()->user()->nivel_instruccion) == 'Técnico')>Técnico</option>
                    <option value="Universitario" @selected(old('nivel_instruccion', auth()->user()->nivel_instruccion) == 'Universitario')>Universitario</option>
                    <option value="Postgrado" @selected(old('nivel_instruccion', auth()->user()->nivel_instruccion) == 'Postgrado')>Postgrado</option>
                </select>

                {{-- CARGA FAMILIAR --}}
                <label class="block text-sm font-medium text-gray-700 mt-3">Número de cargas familiares</label>
                <input type="number" min="0" name="carga_familiar" value="{{ old('carga_familiar', auth()->user()->carga_familiar) }}" class="form-control w-full">

                {{-- PROFESIÓN --}}
                <label class="block text-sm font-medium text-gray-700 mt-3">Profesión</label>
                <input type="text" name="profesion" value="{{ old('profesion', auth()->user()->profesion) }}" class="form-control w-full" placeholder="Ej: Ingeniero">

                {{-- LUGAR DONDE LABORA --}}
                <label class="block text-sm font-medium text-gray-700 mt-3">Lugar donde labora</label>
                <input type="text" name="lugar_labora" value="{{ old('lugar_labora', auth()->user()->lugar_labora) }}" class="form-control w-full" placeholder="Empresa / Institución">

                {{-- CONDICIÓN LABORAL --}}
                <label class="block text-sm font-medium text-gray-700 mt-3">Condición laboral</label>
                <select name="condicion_laboral" class="form-select w-full">
                    <option value="">Seleccione</option>
                    <option value="Dependiente"  @selected(old('condicion_laboral', auth()->user()->condicion_laboral) == 'Dependiente')>Dependiente</option>
                    <option value="Independiente" @selected(old('condicion_laboral', auth()->user()->condicion_laboral) == 'Independiente')>Independiente</option>
                    <option value="Desempleado"  @selected(old('condicion_laboral', auth()->user()->condicion_laboral) == 'Desempleado')>Desempleado</option>
                </select>

                {{-- ESTATUS LABORAL --}}
                <label class="block text-sm font-medium text-gray-700 mt-3">Estatus laboral</label>
                <select name="estatus_laboral" class="form-select w-full">
                    <option value="">Seleccione</option>
                    <option value="Activo"  @selected(old('estatus_laboral', auth()->user()->estatus_laboral) == 'Activo')>Activo</option>
                    <option value="Pasivo"  @selected(old('estatus_laboral', auth()->user()->estatus_laboral) == 'Pasivo')>Pasivo</option>
                </select>

                {{-- CENTRO DE VOTACIÓN --}}
                <label class="block text-sm font-medium text-gray-700 mt-3">Centro de votación (opcional)</label>
                <input type="text" name="centro_votacion" value="{{ old('centro_votacion', auth()->user()->centro_votacion) }}" class="form-control w-full" placeholder="Nombre del centro">

                {{-- DISCAPACIDAD --}}
                <label class="block text-sm font-medium text-gray-700 mt-3">¿Tiene discapacidad?</label>
                <select name="tiene_discapacidad" class="form-select w-full">
                    <option value="0" @selected(!auth()->user()->tiene_discapacidad)>No</option>
                    <option value="1" @selected(auth()->user()->tiene_discapacidad)>Sí</option>
                </select>

                {{-- CONDICIÓN DE SALUD --}}
                <label class="block text-sm font-medium text-gray-700 mt-3">Condición de salud (opcional)</label>
                <textarea name="condicion_salud" rows="2" class="form-control w-full" placeholder="Descripción breve">{{ old('condicion_salud', auth()->user()->condicion_salud) }}</textarea>

                {{-- BOTÓN GUARDAR --}}
                <div class="flex items-center justify-between mt-6">
                    <button type="submit" class="btn btn-primary">Guardar Perfil</button>
                    <a href="{{ route('propietario.dashboard') }}" class="btn btn-outline-secondary btn-sm">Volver</a>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- Alpine.js para el desplegable (opcional, solo si usas Livewire/Volt) --}}
@push('scripts')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush