<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Crear Cliente</h2>

    <form action="<?php echo e(route('admin.clientes.store')); ?>" method="POST" class="card p-4 shadow">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre *</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido *</label>
            <input type="text" name="apellido" id="apellido" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tipo_documento" class="form-label">Tipo de Documento *</label>
            <select name="tipo_documento" id="tipo_documento" class="form-select" required>
                <option value="">Seleccione...</option>
                <option value="CEDULA">Cédula</option>
                <option value="NIT">NIT</option>
                <option value="PASAPORTE">Pasaporte</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="documento" class="form-label">Número de Documento *</label>
            <input type="text" name="documento" id="documento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control">
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control">
        </div>

        <div class="text-end">
            <a href="<?php echo e(route('admin.clientes.index')); ?>" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>

</body>
</html>
<?php /**PATH /workspace/laravel/parcial/resources/views/admin/clientes/create.blade.php ENDPATH**/ ?>