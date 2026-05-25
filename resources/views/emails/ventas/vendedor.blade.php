<h1>Venta registrada</h1>

<p>Se ha registrado una compra relacionada con tus productos.</p>

<p>
    <strong>Cliente:</strong>
    {{ $ventaBase->cliente->nombre }} {{ $ventaBase->cliente->apellidos }}
</p>

<p>
    <strong>Correo del cliente:</strong>
    {{ $ventaBase->cliente->email }}
</p>

<p>
    <strong>Fecha:</strong>
    {{ $ventaBase->fecha->format('d/m/Y') }}
</p>

<p>
    <strong>Referencia de pago:</strong>
    {{ $ventaBase->referencia_pago ?? 'Sin referencia' }}
</p>

<p>
    <strong>Método de pago:</strong>
    {{ strtoupper($ventaBase->metodo_pago ?? 'No especificado') }}
</p>

<h2>Productos vendidos</h2>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th align="left">Producto</th>
            <th align="center">Cantidad</th>
            <th align="right">Precio unitario</th>
            <th align="right">Subtotal</th>
        </tr>
    </thead>

    <tbody>
        @foreach($ventas as $venta)
        <tr>
            <td>{{ $venta->producto->nombre }}</td>
            <td align="center">{{ $venta->cantidad }}</td>
            <td align="right">${{ number_format($venta->producto->precio, 2) }}</td>
            <td align="right">${{ number_format($venta->total, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p>
    <strong>Total registrado:</strong>
    ${{ number_format($total, 2) }}
</p>