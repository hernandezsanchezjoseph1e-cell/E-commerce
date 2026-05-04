<div class="bg-white p-4 rounded shadow">

    <h2 class="font-bold mb-3">Top comprador por categoría</h2>

    @foreach($topCompradorPorCategoria as $item)
    <div class="mb-2">
        <strong>{{ $item['categoria'] }}</strong>:
        {{ $item['cliente']->nombre ?? 'Sin datos' }}
    </div>
    @endforeach

</div>