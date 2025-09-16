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

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">🏠 Volver al Dashboard</a>
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
            @forelse($ventas as $i => $venta)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        @if($venta->cliente)
                            {{ $venta->cliente->nombre }} {{ $venta->cliente->apellido }}
                        @else
                            <span class="text-muted">Sin cliente</span>
                        @endif
                    </td>
                    <td>${{ number_format($venta->total, 2, ',', '.') }}</td>
                    <td>{{ $venta->fecha }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info">📄 Ver Detalle</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay ventas registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
