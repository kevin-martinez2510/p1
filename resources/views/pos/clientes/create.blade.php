<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Registrar Cliente</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('/pos/clientes') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido">
                </div>

                <div class="mb-3">
                    <label for="tipo_documento" class="form-label">Tipo de documento <span class="text-danger">*</span></label>
                    <select class="form-select" id="tipo_documento" name="tipo_documento" required>
                        <option value="CEDULA">CÉDULA</option>
                        <option value="TARJETA_DE_IDENTIDAD">TARJETA DE IDENTIDAD</option>
                        <option value="PASAPORTE">PASAPORTE</option>
                        <option value="OTRO">OTRO</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="documento" class="form-label">Número de documento <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="documento" name="documento" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono">
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url('/pos') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar Cliente</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
