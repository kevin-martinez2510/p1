<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Venta;
use App\Models\DetalleVenta;

class POSController extends Controller
{
    /**
     * Mostrar la pantalla principal del POS con productos y clientes.
     */
    public function index()
    {
        $productos = Producto::orderBy('nombre')->get();
        // Neon/Postgres: evitar error "cached plan must not change result type"
        $clientes = Cliente::orderByRaw('nombre::text ASC')->get();

        return view('pos.index', compact('productos', 'clientes'));
    }

    /**
     * Procesar checkout: registrar venta con múltiples productos y detalle.
     */
    public function checkout(Request $request)
    {
        // Validación
        $request->validate([
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad'    => 'required|integer|min:1',
            'cliente_id'               => 'nullable|exists:clientes,id',
        ]);

        $totalVenta = 0;

        // Crear venta principal
        $venta = new Venta();
        $venta->cliente_id = $request->cliente_id;
        $venta->total = 0; // Temporal, luego actualizamos
        $venta->save();

        // Recorrer productos y guardar detalle
        foreach ($request->productos as $item) {
            $producto = Producto::findOrFail($item['producto_id']);
            $cantidad = (int) $item['cantidad'];
            $subtotal = $producto->precio * $cantidad;
            $totalVenta += $subtotal;

            // Guardar detalle de la venta
            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $producto->id,
                'cantidad' => $cantidad,
                'precio_unitario' => $producto->precio,
                'subtotal' => $subtotal,
            ]);
        }

        // Actualizar total de la venta
        $venta->total = $totalVenta;
        $venta->save();

        return redirect()->back()
            ->with('success', 'Venta registrada correctamente. Total: $' . number_format($totalVenta, 0, ',', '.'));
    }
}
