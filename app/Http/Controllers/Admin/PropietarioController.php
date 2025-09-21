<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;          // <-- ¡IMPORTACIÓN OBLIGATORIA!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PropietarioController extends Controller
{
    /* Muestra el formulario */
    public function create()
    {
        return view('admin.propietarios.create');
    }

    /* Guarda el propietario */
    public function store(Request $request)
    {
        // Validaciones
        $request->validate([
            'apartamento' => 'required|unique:users,apartamento',
            'dni'         => 'required|unique:users,dni',
        ]);

        // Crear usuario
        User::create([
            'name'             => 'POR COMPLETAR',
            'apellido'         => 'POR COMPLETAR',
            'dni'              => $request->dni,
            'email'            => $request->dni . '@gmail.com',
            'password'         => Hash::make('usuario123'),
            'apartamento'      => $request->apartamento,
            'perfil_completo'  => 0,
            'es_jefe_familia'  => 1,
        ]);

        // Respuesta
        return back()->with('success', 'Propietario de ' . $request->apartamento . ' guardado. Cédula: ' . $request->dni);
    }
}