<div class="bg-white shadow rounded p-4">

    <h3 class="font-bold text-lg">
        {{ $producto->nombre }}
    </h3>

    <p class="text-gray-600 text-sm">
        {{ $producto->descripcion }}
    </p>

    <p class="mt-2 font-semibold">
        ${{ $producto->precio }}
    </p>

    <p class="text-sm text-gray-500">
        Stock: {{ $producto->existencia }}
    </p>

    <button class="mt-3 bg-green-500 text-white px-3 py-1 rounded">
        Agregar
    </button>

</div>