<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Historial de Ventas</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success text-center"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="mb-3 text-end">
        <a href="<?php echo e(route('admin.index')); ?>" class="btn btn-secondary">🏠 Volver al Dashboard</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $ventas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($i + 1); ?></td>
                    <td>
                        <?php if($venta->cliente): ?>
                            <?php echo e($venta->cliente->nombre); ?> <?php echo e($venta->cliente->apellido); ?>

                        <?php else: ?>
                            <span class="text-muted">Sin cliente</span>
                        <?php endif; ?>
                    </td>
                    <td>$<?php echo e(number_format($venta->total, 2, ',', '.')); ?></td>
                    <td><?php echo e($venta->fecha); ?></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info">📄 Ver Detalle</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center">No hay ventas registradas</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH /workspace/laravel/parcial/resources/views/admin/ventas/index.blade.php ENDPATH**/ ?>