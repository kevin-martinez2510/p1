<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Gestión de Clientes</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success text-center"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="mb-3 text-end">
        <a href="<?php echo e(route('admin.clientes.create')); ?>" class="btn btn-primary">➕ Crear Cliente</a>
        <a href="<?php echo e(route('admin.index')); ?>" class="btn btn-secondary">🏠 Volver al Dashboard</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <!-- Aquí usamos el número consecutivo -->
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></td>
                    <td><?php echo e($cliente->email); ?></td>
                    <td><?php echo e($cliente->telefono); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.clientes.edit', $cliente->id)); ?>" class="btn btn-sm btn-warning">✏️ Editar</a>
                        <form action="<?php echo e(route('admin.clientes.destroy', $cliente->id)); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('¿Seguro que quieres eliminar este cliente?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center">No hay clientes registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php /**PATH /workspace/laravel/parcial/resources/views/admin/clientes/index.blade.php ENDPATH**/ ?>