<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

class AdminProductoController extends Controller
{
    /**
     * Mostrar todos los productos.
     */
    public function index()
    {
        $productos = Producto::orderBy('nombre')->get();
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('admin.productos.create');
    }

    /**
     * Guardar nuevo producto.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock'  => 'required|integer|min:0',
        ]);

        Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock'  => $request->stock,
        ]);

        return redirect()->route('admin.productos.index')
                         ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }

    /**
     * Actualizar producto existente.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock'  => 'required|integer|min:0',
        ]);

        $producto->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock'  => $request->stock,
        ]);

        return redirect()->route('admin.productos.index')
                         ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Eliminar producto.
     * Solo si no tiene ventas registradas.
     */
   public function destroy(Producto $producto)
{
    // Verificar si el producto tiene ventas en detalle_ventas
    if ($producto->detalles()->exists()) {
        return redirect()->route('admin.productos.index')
                         ->with('error', '⚠️ No se puede eliminar este producto porque ya tiene ventas registradas.');
    }

    $producto->delete();

    return redirect()->route('admin.productos.index')
                     ->with('success', '✅ Producto eliminado correctamente.');
}

}
