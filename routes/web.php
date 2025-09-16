<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\POSController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\Admin\AdminProductoController;
use App\Http\Controllers\Admin\AdminVentaController;
use App\Http\Controllers\Admin\AdminClienteController;

// ====================
// RUTAS POS
// ====================
Route::get('/pos', [POSController::class, 'index'])->name('pos.index');
Route::post('/pos/ventas', [VentaController::class, 'store'])->name('pos.ventas.store');

// RUTAS CLIENTES POS
Route::get('/pos/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/pos/clientes', [ClienteController::class, 'store'])->name('clientes.store');

// ====================
// RUTAS ADMIN
// ====================
Route::prefix('admin')->name('admin.')->group(function () {

    // Index principal / Menu Admin
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Productos
    Route::get('productos', [AdminProductoController::class, 'index'])->name('productos.index');
    Route::get('productos/create', [AdminProductoController::class, 'create'])->name('productos.create');
    Route::post('productos', [AdminProductoController::class, 'store'])->name('productos.store');
    Route::get('productos/{producto}/edit', [AdminProductoController::class, 'edit'])->name('productos.edit');
    Route::put('productos/{producto}', [AdminProductoController::class, 'update'])->name('productos.update');
    Route::delete('productos/{producto}', [AdminProductoController::class, 'destroy'])->name('productos.destroy');

    // Clientes
    Route::get('clientes', [AdminClienteController::class, 'index'])->name('clientes.index');
    Route::get('clientes/create', [AdminClienteController::class, 'create'])->name('clientes.create');
    Route::post('clientes', [AdminClienteController::class, 'store'])->name('clientes.store');
    Route::get('clientes/{cliente}/edit', [AdminClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('clientes/{cliente}', [AdminClienteController::class, 'update'])->name('clientes.update');
    Route::delete('clientes/{cliente}', [AdminClienteController::class, 'destroy'])->name('clientes.destroy');

     // Ventas
    Route::get('ventas', [AdminVentaController::class, 'index'])->name('ventas.index'); // dashboard
    Route::get('ventas/{id}/detalle', [AdminVentaController::class, 'detalle'])->name('ventas.detalle'); // modal AJAX
});
