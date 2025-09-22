<?php

namespace App\Http\Controllers\Propietario;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use Illuminate\Http\Request;

class MiPerfilController extends Controller
{
    /* Muestra formulario de SU propio perfil */
    public function __invoke()
    {
        $perfil = auth()->user()->perfil ?? new Perfil();
        return view('propietario.mi-perfil.edit', compact('perfil'));
    }

    /* Guarda SU propio perfil */
    public function update(Request $request)
    {
        $request->validate([
            'sexo'               => 'nullable|in:Masculino,Femenino',
            'fecha_nacimiento'   => 'nullable|date',
            'estado_civil'       => 'nullable|in:Soltero/a,Casado/a,Viudo/a,Divorciado/a',
            'nivel_instruccion'  => 'nullable|in:Primaria,Secundaria,Técnico,Universitario,Postgrado',
            'carga_familiar'     => 'nullable|integer|min:0',
            'profesion'          => 'nullable|string|max:100',
            'lugar_labora'       => 'nullable|string|max:150',
            'condicion_laboral'  => 'nullable|in:Dependiente,Independiente,Desempleado',
            'estatus_laboral'    => 'nullable|in:Activo,Pasivo',
            'centro_votacion'    => 'nullable|string|max:200',
            'tiene_discapacidad' => 'nullable|boolean',
            'condicion_salud'    => 'nullable|string|max:500',
        ]);

        $perfil = auth()->user()->perfil ?? new Perfil(['user_id' => auth()->id()]);
        $perfil->fill([
            'sexo'               => $request->input('sexo') ?: null,
            'fecha_nacimiento'   => $request->input('fecha_nacimiento') ?: null,
            'estado_civil'       => $request->input('estado_civil') ?: null,
            'nivel_instruccion'  => $request->input('nivel_instruccion') ?: null,
            'carga_familiar'     => $request->input('carga_familiar', 0),
            'profesion'          => $request->input('profesion') ?: null,
            'lugar_labora'       => $request->input('lugar_labora') ?: null,
            'condicion_laboral'  => $request->input('condicion_laboral') ?: null,
            'estatus_laboral'    => $request->input('estatus_laboral') ?: null,
            'centro_votacion'    => $request->input('centro_votacion') ?: null,
            'tiene_discapacidad' => $request->boolean('tiene_discapacidad'),
            'condicion_salud'    => $request->input('condicion_salud') ?: null,
        ]);
        $perfil->save();

        return redirect()->route('propietario.mi-perfil.edit')
                         ->with('success', 'Perfil actualizado.');
    }
}