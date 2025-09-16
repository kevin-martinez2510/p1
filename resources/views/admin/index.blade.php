<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container text-center mt-5">
    <h1 class="mb-4">Panel de Administración</h1>
    <p class="text-muted mb-5">Seleccione una opción para gestionar el sistema</p>

    <div class="row justify-content-center">

        <!-- Gestión de Productos -->
<a href="{{ route('admin.productos.index') }}" class="btn btn-primary w-100 py-3">
    📦 Gestión de Productos
</a>

<!-- Gestión de Clientes -->
<a href="{{ route('admin.clientes.index') }}" class="btn btn-success w-100 py-3">
    👤 Gestión de Clientes
</a>

<!-- Gestión de Ventas -->
<a href="{{ route('admin.ventas.index') }}" class="btn btn-warning w-100 py-3">
    💰 Gestión de Ventas
</a>

        </div>
    </div>
</div>

</body>
</html>
