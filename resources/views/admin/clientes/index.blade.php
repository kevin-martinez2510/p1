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

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary">➕ Crear Cliente</a>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">🏠 Volver al Dashboard</a>
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
            @forelse($clientes as $cliente)
                <tr>
                    <!-- Aquí usamos el número consecutivo -->
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cliente->nombre }} {{ $cliente->apellido }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>
                        <a href="{{ route('admin.clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                        <form action="{{ route('admin.clientes.destroy', $cliente->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Seguro que quieres eliminar este cliente?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay clientes registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

