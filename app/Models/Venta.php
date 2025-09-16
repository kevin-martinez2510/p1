<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
        'cliente_id',
        'total',
        'fecha',
    ];

    /**
     * Relación con los detalles de la venta
     */
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }

    /**
     * Relación con el cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    /**
     * Relación con productos a través de detalle_ventas
     */
    public function productos()
    {
        return $this->belongsToMany(
            Producto::class,     // Modelo relacionado
            'detalle_ventas',    // Tabla pivote
            'venta_id',          // FK en detalle_ventas hacia ventas
            'producto_id'        // FK en detalle_ventas hacia productos
        );
    }
}
