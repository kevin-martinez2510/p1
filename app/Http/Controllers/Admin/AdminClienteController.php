<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class AdminClienteController extends Controller
{
    /**
     * Mostrar todos los clientes.
     */
    public function index()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Guardar nuevo cliente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'email'    => 'nullable|email|unique:clientes,email',
            'telefono' => 'nullable|string|max:20',
        ]);

        Cliente::create($request->all());

        return redirect()->route('admin.clientes.index')
                         ->with('success', 'Cliente creado correctamente.');
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Cliente $cliente)
    {
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Actualizar cliente.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'email'    => 'nullable|email|unique:clientes,email,' . $cliente->id,
            'telefono' => 'nullable|string|max:20',
        ]);

        $cliente->update($request->all());

        return redirect()->route('admin.clientes.index')
                         ->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Eliminar cliente.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('admin.clientes.index')
                         ->with('success', 'Cliente eliminado correctamente.');
    }
}
