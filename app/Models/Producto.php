<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
    ];

    /**
     * Relación con los detalles de venta
     */
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'producto_id');
    }

    /**
     * Relación con ventas a través de detalle_ventas
     */
    public function ventas()
    {
        return $this->hasManyThrough(
            Venta::class,        // Modelo final
            DetalleVenta::class, // Modelo intermedio
            'producto_id',       // Clave foránea en detalle_ventas
            'id',                // Clave primaria en ventas
            'id',                // Clave primaria en productos
            'venta_id'           // Clave foránea en detalle_ventas
        );
    }
}
