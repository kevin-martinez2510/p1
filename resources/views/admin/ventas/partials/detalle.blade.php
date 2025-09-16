<div class="table-responsive">
    <h5>Cliente: {{ optional($venta->cliente)->nombre ?? 'Sin cliente' }} {{ optional($venta->cliente)->apellido ?? '' }}</h5>
    <h6>Fecha: {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i') }}</h6>
    <h6>Total: ${{ number_format($venta->total,2,',','.') }}</h6>

    <table class="table table-bordered mt-2">
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
                <td>{{ $i+1 }}</td>
                <td>{{ $item->producto->nombre ?? 'Producto eliminado' }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>${{ number_format($item->precio_unitario,2,',','.') }}</td>
                <td>${{ number_format($item->subtotal,2,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
