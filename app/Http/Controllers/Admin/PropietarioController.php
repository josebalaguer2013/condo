<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PropietarioController extends Controller
{
    /* Muestra el formulario de alta */
    public function create()
    {
        return view('admin.propietarios.create');
    }

    /* Guarda el propietario */
    public function store(Request $request)
    {
        // Validaciones básicas
        $request->validate([
            'apartamento' => 'required|unique:users,apartamento', // no repetir
            'dni'         => 'required|unique:users,dni',         // cédula única
        ]);

        // Crear usuario (propietario)
        User::create([
            'name'             => 'POR COMPLETAR',      // se llenará después
            'apellido'         => 'POR COMPLETAR',
            'dni'              => $request->dni,
            'email'            => $request->dni.'@condo.com', // email provisional
            'password'         => Hash::make('usuario123'),  // clave fija
            'apartamento'      => $request->apartamento,
            'perfil_completo'  => 0,           // obligará a completar datos
            'es_jefe_familia'  => 1,           // es el titular del apartamento
        ]);

        // Redirigir con mensaje
        return back()->with('success', 'Propietario de '.$request->apartamento.' registrado. Cedula: '.$request->dni);
    }
}