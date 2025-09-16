@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalle de Venta #{{ $venta->id }}</h2>

    <div class="card shadow-sm p-3 mb-4">
        <h5>Cliente:</h5>
        <p>{{ optional($venta->cliente)->nombre ?? 'Sin cliente' }} {{ optional($venta->cliente)->apellido ?? '' }}</p>
        <h5>Fecha:</h5>
        <p>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i') }}</p>
        <h5>Total:</h5>
        <p>${{ number_format($venta->total,2,',','.') }}</p>
    </div>

    <div class="card shadow-sm p-3">
        <h5>Productos</h5>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->items as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->producto->nombre ?? 'Producto eliminado' }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->precio_unitario,2,',','.') }}</td>
                    <td>${{ number_format($item->subtotal,2,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('admin.ventas.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
