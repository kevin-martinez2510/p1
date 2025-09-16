<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Carbon\Carbon;

class VentaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'productos'  => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad'    => 'required|integer|min:1',
        ]);

        // Crear la venta inicial (total en 0 temporal)
        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'total'      => 0,
            'fecha'      => Carbon::now(),
        ]);

        $total = 0;

        foreach ($request->productos as $item) {
            $producto = Producto::findOrFail($item['producto_id']);

            // Validar stock disponible
            if ($producto->stock < $item['cantidad']) {
                return redirect()->back()
                    ->with('error', "Stock insuficiente para el producto {$producto->nombre}");
            }

            $subtotal = $producto->precio * $item['cantidad'];

            // Crear detalle de la venta
            DetalleVenta::create([
                'venta_id'       => $venta->id,
                'producto_id'    => $producto->id,
                'cantidad'       => $item['cantidad'],
                'precio_unitario'=> $producto->precio,
                'subtotal'       => $subtotal,
            ]);

            // Actualizar stock del producto
            $producto->decrement('stock', $item['cantidad']);

            $total += $subtotal;
        }

        // Actualizar total de la venta
        $venta->update(['total' => $total]);

        return redirect()->route('pos.index')
            ->with('success', 'Venta registrada correctamente y stock actualizado.');
    }
}
