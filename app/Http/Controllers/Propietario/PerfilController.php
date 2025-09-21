<?php

namespace App\Http\Controllers\Propietario;

use App\Http\Controllers\Controller;
use App\Models\Perfil;   // tu nuevo modelo
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    /**
     * Muestra el formulario de edición
     */
    public function edit()
    {
        // Carga el perfil o uno vacío para evitar nulls en la vista
        $perfil = auth()->user()->perfil ?? new Perfil();
        return view('propietario.perfil.edit', compact('perfil'));
    }

    /**
     * Guarda o actualiza el perfil
     */
    public function update(Request $request)
    {
        // Validaciones
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

        // Obtén o crea el perfil del usuario logueado
        $perfil = auth()->user()->perfil ?? new Perfil(['user_id' => auth()->id()]);

        // Rellena y guarda
        $perfil->fill($request->only([
            'sexo','fecha_nacimiento','estado_civil','nivel_instruccion','carga_familiar',
            'profesion','lugar_labora','condicion_laboral','estatus_laboral','centro_votacion',
            'tiene_discapacidad','condicion_salud'
        ]));
        $perfil->save();

        return back()->with('success', 'Perfil actualizado.');
    }
}