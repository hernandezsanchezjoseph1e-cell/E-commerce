<div class="bg-white p-4 rounded shadow">

    <h2 class="font-bold mb-3">Producto más vendido</h2>

    <div>
        {{ $productoMasVendido->nombre ?? 'Sin datos' }}
        ({{ $productoMasVendido->ventas_count ?? 0 }} ventas)
    </div>

</div>