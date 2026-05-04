<div class="bg-white p-4 rounded shadow">

    <h2 class="font-bold mb-3">Productos por categoría</h2>

    @foreach($productosPorCategoria as $categoria)
    <div class="mb-2">
        <strong>{{ $categoria->nombre }}</strong>:
        {{ $categoria->productos->count() }}
    </div>
    @endforeach

</div>