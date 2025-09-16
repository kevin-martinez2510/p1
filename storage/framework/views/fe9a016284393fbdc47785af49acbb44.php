<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">📊 Dashboard de Ventas (Semana actual)</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-center">
                <small class="text-muted">Total semana actual</small>
                <div class="h3 mt-2">$<?php echo e(number_format($totalSemana, 2, ',', '.')); ?></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-center">
                <small class="text-muted">Total semana pasada</small>
                <div class="h3 mt-2">$<?php echo e(number_format($totalSemanaPasada, 2, ',', '.')); ?></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-center">
                <small class="text-muted">Comparación vs semana pasada</small>
                <div class="h3 mt-2 <?php echo e($diferencia >= 0 ? 'text-success' : 'text-danger'); ?>">
                    <?php echo e($diferencia >= 0 ? '+' : ''); ?><?php echo e(number_format($diferencia, 2)); ?>%
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfica -->
    <div class="card mb-4 shadow-sm p-3">
        <h5 class="mb-3">Evolución diaria (Semana actual)</h5>
        <canvas id="chartVentas" height="120"></canvas>
    </div>

    <!-- Tabla dinámica -->
    <div class="card shadow-sm p-3">
        <h5 class="mb-3">Ventas esta semana</h5>
        <table id="tablaVentas" class="table table-striped table-bordered">
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
                <?php $__currentLoopData = $ventas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i + 1); ?></td>
                        <td><?php echo e(optional($venta->cliente)->nombre ?? 'Sin cliente'); ?> <?php echo e(optional($venta->cliente)->apellido ?? ''); ?></td>
                        <td>$<?php echo e(number_format($venta->total, 2, ',', '.')); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i')); ?></td>
                        <td>
                            <button 
                                class="btn btn-sm btn-info ver-detalle" 
                                data-id="<?php echo e($venta->id); ?>"
                            >
                                Ver detalle
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDetalleVenta" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalle de Venta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="contenidoDetalle">
            <!-- Aquí se carga el detalle con AJAX -->
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const etiquetas = <?php echo json_encode($labels); ?>;
const valores = <?php echo json_encode($data); ?>;

const ctx = document.getElementById('chartVentas').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: etiquetas,
        datasets: [{
            label: 'Ventas ($)',
            data: valores,
            tension: 0.3,
            fill: true,
            backgroundColor: 'rgba(13,110,253,0.12)',
            borderColor: 'rgba(13,110,253,1)',
            pointRadius: 4
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>

<script>
$(document).ready(function () {
    $('#tablaVentas').DataTable({
        order: [[3, 'desc']],
        pageLength: 25
    });

    // Delegación de eventos para botones dentro de DataTables
$('#tablaVentas').on('click', '.ver-detalle', function () {
    let id = $(this).data('id');
    let url = "<?php echo e(route('admin.ventas.detalle', ['id' => ':id'])); ?>";
    url = url.replace(':id', id);

    $('#contenidoDetalle').html('<p class="text-center">Cargando...</p>');

    $.get(url, function (data) {
        $('#contenidoDetalle').html(data);
        var modal = new bootstrap.Modal(document.getElementById('modalDetalleVenta'));
        modal.show();
    });
});


});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspace/laravel/parcial/resources/views/admin/ventas/dashboard.blade.php ENDPATH**/ ?>