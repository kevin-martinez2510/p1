<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Gestión de Productos</h2>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <div class="mb-3 text-end">
        <a href="<?php echo e(route('admin.productos.create')); ?>" class="btn btn-primary">➕ Crear Producto</a>
        <a href="<?php echo e(route('admin.index')); ?>" class="btn btn-secondary">🏠 Volver al Dashboard</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($producto->id); ?></td>
                    <td><?php echo e($producto->nombre); ?></td>
                    <td>$<?php echo e(number_format($producto->precio, 0, ',', '.')); ?></td>
                    <td><?php echo e($producto->stock); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.productos.edit', $producto->id)); ?>" class="btn btn-sm btn-warning">✏️ Editar</a>
                        
                        <form action="<?php echo e(route('admin.productos.destroy', $producto->id)); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('¿Seguro que quieres eliminar este producto?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center">No hay productos registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php /**PATH /workspace/laravel/parcial/resources/views/admin/productos/index.blade.php ENDPATH**/ ?>