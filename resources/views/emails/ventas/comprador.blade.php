<h1>Compra confirmada</h1>

<p>Tu compra ha sido confirmada correctamente.</p>

<p>
    <strong>Vendedor:</strong>
    {{ $ventaBase->vendedor->nombre }} {{ $ventaBase->vendedor->apellidos }}
</p>

<p>
    <strong>Correo del vendedor:</strong>
    {{ $ventaBase->vendedor->email }}
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

<h2>Productos comprados</h2>

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
    <strong>Total de la compra:</strong>
    ${{ number_format($total, 2) }}
</p>

<p>
    Puedes contactar al vendedor mediante el correo indicado para dar seguimiento a tu compra.
</p>