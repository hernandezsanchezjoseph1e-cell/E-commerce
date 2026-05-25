<div class="bg-white shadow rounded p-6">

    <h3 class="font-bold mb-4">
        Producto más vendido
    </h3>

    @if($productoMasVendido)

    <p>
        {{ $productoMasVendido->nombre }}
        ({{ $productoMasVendido->unidades_vendidas ?? 0 }} unidades vendidas)
    </p>

    @else

    <p class="text-gray-500">
        No hay ventas registradas.
    </p>

    @endif

</div>