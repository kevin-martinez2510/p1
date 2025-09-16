<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Crear Producto</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.productos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio') }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">🔙 Volver</a>
            <button type="submit" class="btn btn-success">💾 Guardar Producto</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

