@extends('layouts.app')

@section('title', 'Mi carrito')

@section('content')

<div class="container mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Mi carrito
        </h1>

        <a href="{{ route('dashboard.cliente') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded">
            Seguir comprando
        </a>
    </div>

    {{-- MENSAJE DE ÉXITO --}}
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    {{-- ERRORES --}}
    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc ml-5">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if($productos->isEmpty())

    <div class="bg-white shadow rounded p-6 text-center">
        <p class="text-gray-600 mb-4">
            Tu carrito está vacío.
        </p>

        <a href="{{ route('dashboard.cliente') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Ver productos
        </a>
    </div>

    @else

    <div class="bg-white shadow rounded overflow-hidden mb-6">

        <table class="w-full border-collapse">

            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="p-3 text-left">Producto</th>
                    <th class="p-3 text-left">Vendedor</th>
                    <th class="p-3 text-right">Precio</th>
                    <th class="p-3 text-center">Cantidad</th>
                    <th class="p-3 text-right">Subtotal</th>
                    <th class="p-3 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($productos as $producto)

                <tr class="border-b">

                    <td class="p-3">
                        <div class="flex items-center gap-3">

                            @if($producto->fotos && count($producto->fotos) > 0)
                            <img src="{{ asset('storage/' . $producto->fotos[0]) }}" alt="{{ $producto->nombre }}" class="w-16 h-16 object-cover rounded">
                            @else
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-gray-500 text-xs">
                                Sin imagen
                            </div>
                            @endif

                            <div>
                                <p class="font-semibold text-gray-800">
                                    {{ $producto->nombre }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Stock disponible: {{ $producto->existencia }}
                                </p>
                            </div>

                        </div>
                    </td>

                    <td class="p-3">
                        {{ $producto->usuario->nombre ?? 'N/A' }}
                    </td>

                    <td class="p-3 text-right">
                        ${{ number_format($producto->precio, 2) }}
                    </td>

                    <td class="p-3 text-center">
                        <form action="{{ route('carrito.actualizar', $producto) }}" method="POST" class="flex justify-center items-center gap-2">
                            @csrf
                            @method('PATCH')

                            <input type="number" name="cantidad" min="1" max="{{ $producto->existencia }}" value="{{ $producto->cantidad_carrito }}" class="border rounded px-2 py-1 w-20 text-center">

                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                Actualizar
                            </button>
                        </form>
                    </td>

                    <td class="p-3 text-right font-semibold">
                        ${{ number_format($producto->subtotal_carrito, 2) }}
                    </td>

                    <td class="p-3 text-center">
                        <form action="{{ route('carrito.eliminar', $producto) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto del carrito?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                Eliminar
                            </button>
                        </form>
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <div class="bg-white shadow rounded p-6">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">
                Total
            </h2>

            <p class="text-2xl font-bold text-green-700">
                ${{ number_format($total, 2) }}
            </p>
        </div>

        <form action="{{ route('carrito.comprar') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf

            <div class="mb-4">
                <label for="metodo_pago" class="block mb-1 font-semibold">
                    Método de pago
                </label>

                <select id="metodo_pago" name="metodo_pago" class="border p-2 w-full rounded" required>
                    <option value="">Seleccione un método de pago</option>
                    <option value="oxxo">Pago en punto de venta / OXXO</option>
                    <option value="transferencia">Transferencia bancaria</option>
                    <option value="tarjeta">Tarjeta de crédito/débito</option>
                </select>

                @error('metodo_pago')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Confirmar compra
            </button>
        </form>

        <form action="{{ route('carrito.vaciar') }}" method="POST" onsubmit="return confirm('¿Vaciar todo el carrito?')">
            @csrf
            @method('DELETE')

            <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Vaciar carrito
            </button>
        </form>

    </div>

    @endif

</div>

@endsection