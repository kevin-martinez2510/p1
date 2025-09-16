<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS - Sistema de Facturación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Sistema de Facturación - Empanadas</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form id="ventaForm" action="{{ route('pos.ventas.store') }}" method="POST">
        @csrf

        <!-- Selección de cliente -->
        <div class="card shadow mb-4">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">Cliente (Opcional)</h5>
            </div>
            <div class="card-body">
                <div class="row g-2 align-items-end">
                    <div class="col-md-8">
                        <label for="cliente_id" class="form-label fw-bold">Seleccionar cliente:</label>
                        <select class="form-select" id="cliente_id" name="cliente_id">
                            <option value="">-- Venta sin cliente --</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('clientes.create') }}" class="btn btn-success">Registrar Cliente</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selección de productos -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Productos</h5>
            </div>
            <div class="card-body">
                <div id="productos-container">
                    <div class="producto-row row g-2 mb-3">
                        <div class="col-md-6">
                            <select class="form-select" name="productos[0][producto_id]" required>
                                <option value="">-- Seleccione producto --</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->nombre }} - ${{ number_format($producto->precio, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" name="productos[0][cantidad]" value="1" min="1" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-producto">X</button>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <button type="button" class="btn btn-secondary" id="agregar-producto">Agregar Producto</button>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Registrar Venta</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let productoIndex = 1;

    document.getElementById('agregar-producto').addEventListener('click', function() {
        const container = document.getElementById('productos-container');
        const newRow = document.querySelector('.producto-row').cloneNode(true);

        // Limpiar valores
        newRow.querySelector('select').name = `productos[${productoIndex}][producto_id]`;
        newRow.querySelector('select').value = '';
        newRow.querySelector('input').name = `productos[${productoIndex}][cantidad]`;
        newRow.querySelector('input').value = 1;

        container.appendChild(newRow);
        productoIndex++;
    });

    document.getElementById('productos-container').addEventListener('click', function(e) {
        if(e.target && e.target.classList.contains('remove-producto')) {
            const rows = document.querySelectorAll('.producto-row');
            if(rows.length > 1) {
                e.target.closest('.producto-row').remove();
            }
        }
    });
</script>

</body>
</html>
