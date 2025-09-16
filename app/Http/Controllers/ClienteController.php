<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Mostrar el formulario para registrar un nuevo cliente.
     */
    public function create()
    {
        return view('pos.clientes.create');
    }

    /**
     * Guardar un nuevo cliente en la base de datos.
     */
    public function store(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'tipo_documento' => 'required|string|in:CEDULA,TARJETA_DE_IDENTIDAD,PASAPORTE,OTRO',
            'documento' => 'required|string|max:50|unique:clientes,documento',
            'email' => 'nullable|email|max:255|unique:clientes,email',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        // Crear cliente
        Cliente::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'tipo_documento' => $request->tipo_documento,
            'documento' => $request->documento,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        // Redirigimos al index del POS con un mensaje
        return redirect()->route('pos.index')
            ->with('success', 'Cliente registrado correctamente.');
    }
}
