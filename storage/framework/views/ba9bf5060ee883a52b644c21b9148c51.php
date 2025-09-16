<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('admin.index')); ?>">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.productos.index')); ?>">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.clientes.index')); ?>">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.ventas.index')); ?>">Ventas</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH /workspace/laravel/parcial/resources/views/layouts/admin.blade.php ENDPATH**/ ?>