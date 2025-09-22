<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Perfil;
use Illuminate\Http\Request;

class UsuarioPerfilController extends Controller
{
    /* ---------- LISTAR ---------- */
    public function index()
    {
        $usuarios = User::with('perfil')->where('is_admin', 0)->paginate(20);
        return view('admin.usuarios-perfiles.index', compact('usuarios'));
    }

    /* ---------- VER FORMULARIO EDICIÓN ---------- */
    public function edit(User $usuarios_perfile)
    {
        // Cargamos el perfil o uno vacío para evitar nulls
        $perfil = $usuarios_perfile->perfil ?? new Perfil();
        return view('admin.usuarios-perfiles.edit', compact('usuarios_perfile', 'perfil'));
    }

    /* ---------- ACTUALIZAR USUARIO + PERFIL ---------- */
    public function update(Request $request, User $usuarios_perfile)
    {
        // Validación
        $request->validate([
            'name'               => 'required|string|max:255',
            'apellido'           => 'required|string|max:255',
            'telefono'           => 'nullable|string|max:20',
            'email'              => 'required|email|unique:users,email,'.$usuarios_perfile->id,
            // Perfil
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

        // Actualizar usuario
        $usuarios_perfile->update($request->only(['name', 'apellido', 'telefono', 'email']));

        // Actualizar o crear perfil
        $perfil = $usuarios_perfile->perfil ?? new Perfil(['user_id' => $usuarios_perfile->id]);
        $perfil->fill($request->only([
            'sexo','fecha_nacimiento','estado_civil','nivel_instruccion','carga_familiar',
            'profesion','lugar_labora','condicion_laboral','estatus_laboral','centro_votacion',
            'tiene_discapacidad','condicion_salud'
        ]));
        $perfil->save();

        return redirect()->route('admin.usuarios-perfiles.index')
                         ->with('success', 'Usuario y perfil actualizados.');
    }

    /* ---------- ELIMINAR USUARIO + PERFIL (CASCADA) ---------- */
    public function destroy(User $usuarios_perfile)
    {
        // Borra perfil primero (por seguridad) y luego usuario
        optional($usuarios_perfile->perfil)->delete();
        $usuarios_perfile->delete();

        return redirect()->route('admin.usuarios-perfiles.index')
                         ->with('success', 'Usuario eliminado.');
    }
}