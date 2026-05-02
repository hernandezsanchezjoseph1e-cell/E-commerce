<h2 class="text-xl font-semibold mt-8 mb-4">
    {{ $categoria->nombre }}
</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    @foreach($categoria->productos as $producto)
    @include('cliente.components.producto-card', ['producto' => $producto])
    @endforeach

</div>