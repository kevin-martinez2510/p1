<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Editar Producto</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success text-center"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">
            <form action="<?php echo e(route('admin.productos.update', $producto->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"
                           value="<?php echo e(old('nombre', $producto->nombre)); ?>" required>
                    <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger mt-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio" step="0.01"
                           value="<?php echo e(old('precio', $producto->precio)); ?>" required>
                    <?php $__errorArgs = ['precio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger mt-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock"
                           value="<?php echo e(old('stock', $producto->stock)); ?>" required>
                    <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger mt-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('admin.productos.index')); ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH /workspace/laravel/parcial/resources/views/admin/productos/edit.blade.php ENDPATH**/ ?>