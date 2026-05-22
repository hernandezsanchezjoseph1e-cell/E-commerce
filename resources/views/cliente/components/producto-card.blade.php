<div class="bg-white shadow rounded p-4">

    {{-- Imagen principal del producto --}}
    @if($producto->fotos && count($producto->fotos) > 0)

    <img src="{{ asset('storage/' . $producto->fotos[0]) }}" alt="{{ $producto->nombre }}" class="w-full h-48 object-cover rounded mb-4">

    @else

    <div class="w-full h-48 bg-gray-200 rounded mb-4 flex items-center justify-center text-gray-500">
        Sin imagen
    </div>

    @endif

    <h3 class="font-bold text-lg">
        {{ $producto->nombre }}
    </h3>

    <p class="text-gray-600 text-sm">
        {{ $producto->descripcion }}
    </p>

    <p class="mt-2 font-semibold">
        ${{ number_format($producto->precio, 2) }}
    </p>

    <p class="text-sm text-gray-500">
        Stock: {{ $producto->existencia }}
    </p>

    @if($producto->existencia > 0)

    <form action="{{ route('carrito.agregar', $producto) }}" method="POST" class="mt-3">

        @csrf

        <div class="flex items-center gap-2">

            <input type="number" name="cantidad" min="1" max="{{ $producto->existencia }}" value="1" class="border rounded px-2 py-1 w-20">

            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                Agregar
            </button>

        </div>

    </form>

    @else

    <span class="inline-block mt-3 bg-gray-300 text-gray-700 px-3 py-1 rounded">
        Sin stock
    </span>

    @endif

</div>