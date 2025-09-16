<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // Llave primaria autoincremental
            $table->string('nombre'); // Nombre del cliente
            $table->string('email')->unique()->nullable(); // Email único (puede ser nulo)
            $table->string('telefono')->nullable(); // Teléfono opcional
            $table->string('direccion')->nullable(); // Dirección opcional
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
