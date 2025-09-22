@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-900 rounded-xl shadow mt-6">

    {{-- Título + botón volver al Dashboard --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-red-600">🇻🇪 Mi Perfil</h1>
        <a href="{{ route('propietario.dashboard') }}" class="px-4 py-2 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 text-gray-900 dark:text-gray-100 rounded-lg hover:scale-105 transition transform shadow">
            ⬅ Volver al Dashboard
        </a>
    </div>

    {{-- Mensajes --}}
    @if(session('success'))
        <div class="mb-4 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-200 border-l-4 border-emerald-500 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="mb-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 border-l-4 border-red-500 px-4 py-3 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORMULARIO FUNCIONAL --}}
    <form method="POST" action="{{ route('propietario.mi-perfil.update') }}">
        @csrf @method('PUT')

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Sexo</label>
                <select name="sexo" class="w-full mt-1 rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                    <option value="">Seleccione</option>
                    <option value="Masculino" @selected(old('sexo', optional($perfil)->sexo) == 'Masculino')>Masculino</option>
                    <option value="Femenino"  @selected(old('sexo', optional($perfil)->sexo)  == 'Femenino')>Femenino</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Fecha nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', optional($perfil)->fecha_nacimiento) }}" class="w-full mt-1 rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Estado civil</label>
                <select name="estado_civil" class="w-full mt-1 rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                    <option value="">Seleccione</option>
                    <option value="Soltero/a"   @selected(old('estado_civil', optional($perfil)->estado_civil) == 'Soltero/a')>Soltero/a</option>
                    <option value="Casado/a"    @selected(old('estado_civil', optional($perfil)->estado_civil) == 'Casado/a')>Casado/a</option>
                    <option value="Viudo/a"     @selected(old('estado_civil', optional($perfil)->estado_civil) == 'Viudo/a')>Viudo/a</option>
                    <option value="Divorciado/a" @selected(old('estado_civil', optional($perfil)->estado_civil) == 'Divorciado/a')>Divorciado/a</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nivel instrucción</label>
                <select name="nivel_instruccion" class="w-full mt-1 rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                    <option value="">Seleccione</option>
                    <option value="Primaria" @selected(old('nivel_instruccion', optional($perfil)->nivel_instruccion) == 'Primaria')>Primaria</option>
                    <option value="Secundaria" @selected(old('nivel_instruccion', optional($perfil)->nivel_instruccion) == 'Secundaria')>Secundaria</option>
                    <option value="Técnico" @selected(old('nivel_instruccion', optional($perfil)->nivel_instruccion) == 'Técnico')>Técnico</option>
                    <option value="Universitario" @selected(old('nivel_instruccion', optional($perfil)->nivel_instruccion) == 'Universitario')>Universitario</option>
                    <option value="Postgrado" @selected(old('nivel_instruccion', optional($perfil)->nivel_instruccion) == 'Postgrado')>Postgrado</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Cargas familiares</label>
                <input type="number" min="0" name="carga_familiar" value="{{ old('carga_familiar', optional($perfil)->carga_familiar) }}" class="w-full mt-1 rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Profesión</label>
                <input type="text" name="profesion" value="{{ old('profesion', optional($perfil)->profesion) }}" class="w-full mt-1 rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow" placeholder="Ej: Ingeniero">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Lugar donde labora</label>
                <input type="text" name="lugar_labora" value="{{ old('lugar_labora', optional($perfil)->lugar_labora) }}" class="w-full mt-1 rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow" placeholder="Empresa / Institución">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Condición laboral</label>
                <select name="condicion_laboral" class="w-full mt-1 rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                    <option value="">Seleccione</option>
                    <option value="Dependiente"  @selected(old('condicion_laboral', optional($perfil)->condicion_laboral) == 'Dependiente')>Dependiente</option>
                    <option value="Independiente" @selected(old('condicion_laboral', optional($perfil)->condicion_laboral) == 'Independiente')>Independiente</option>
                    <option value="Desempleado"  @selected(old('condicion_laboral', optional($perfil)->condicion_laboral) == 'Desempleado')>Desempleado</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Estatus laboral</label>
                <select name="estatus_laboral" class="w-full mt-1 rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                    <option value="">Seleccione</option>
                    <option value="Activo" @selected(old('estatus_laboral', optional($perfil)->estatus_laboral) == 'Activo')>Activo</option>
                    <option value="Pasivo" @selected(old('estatus_laboral', optional($perfil)->estatus_laboral) == 'Pasivo')>Pasivo</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Centro de votación</label>
                <input type="text" name="centro_votacion" value="{{ old('centro_votacion', optional($perfil)->centro_votacion) }}" class="w-full mt-1 rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow" placeholder="Nombre del centro">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">¿Tiene discapacidad?</label>
                    <select name="tiene_discapacidad" class="w-full mt-1 rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow">
                        <option value="0" @selected(!optional($perfil)->tiene_discapacidad)>No</option>
                        <option value="1" @selected(optional($perfil)->tiene_discapacidad)>Sí</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Condición de salud</label>
                    <textarea name="condicion_salud" rows="3" class="w-full mt-1 rounded-lg border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 shadow" placeholder="Descripción breve">{{ old('condicion_salud', optional($perfil)->condicion_salud) }}</textarea>
                </div>
            </div>

            {{-- BOTONES DE ACCIÓN --}}
            <div class="flex items-center justify-between mt-8">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition transform hover:scale-105 shadow-lg">
                    Guardar Perfil
                </button>
                <a href="{{ route('propietario.dashboard') }}" class="px-4 py-2 bg-gradient-to-r from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-700 text-gray-900 dark:text-gray-100 rounded-lg hover:scale-105 transition shadow">
                    Volver al Dashboard
                </a>
            </div>
        </div>
    </form>
</div>
@endsection