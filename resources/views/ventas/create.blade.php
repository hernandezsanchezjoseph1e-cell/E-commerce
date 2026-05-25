@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold">
            Ventas pendientes
        </h1>

        <a href="{{ route('ventas.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded">
            Ver ventas registradas
        </a>

    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc ml-5">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @forelse($ventas as $referencia => $grupoVentas)

    @php
    $ventaBase = $grupoVentas->first();
    $total = $grupoVentas->sum('total');
    @endphp

    <div class="bg-white shadow rounded p-6 mb-5">

        <div class="flex justify-between items-start mb-4">

            <div>
                <h2 class="text-lg font-bold text-gray-800">
                    Compra {{ $referencia }}
                </h2>

                <p class="text-sm text-gray-500">
                    Fecha: {{ $ventaBase->fecha->format('d/m/Y') }}
                </p>
            </div>

            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-sm font-semibold">
                Pendiente
            </span>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            <div>
                <p class="text-sm text-gray-500">
                    Cliente
                </p>

                <p class="font-semibold">
                    {{ $ventaBase->cliente->nombre }} {{ $ventaBase->cliente->apellidos }}
                </p>

                <p class="text-sm text-gray-600">
                    {{ $ventaBase->cliente->email }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Método de pago
                </p>

                <p class="font-semibold uppercase">
                    {{ $ventaBase->metodo_pago ?? 'No especificado' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Referencia de pago
                </p>

                <p class="font-semibold">
                    {{ $ventaBase->referencia_pago ?? 'Sin referencia' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Código de pago
                </p>

                <p class="font-semibold">
                    {{ $ventaBase->codigo_pago ?? 'Sin código' }}
                </p>
            </div>

        </div>

        <div class="border rounded mb-4 overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Producto</th>
                        <th class="p-2 text-center">Cantidad</th>
                        <th class="p-2 text-right">Precio</th>
                        <th class="p-2 text-right">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($grupoVentas as $venta)
                    <tr class="border-t">
                        <td class="p-2">
                            {{ $venta->producto->nombre }}
                        </td>

                        <td class="p-2 text-center">
                            {{ $venta->cantidad }}
                        </td>

                        <td class="p-2 text-right">
                            ${{ number_format($venta->producto->precio, 2) }}
                        </td>

                        <td class="p-2 text-right">
                            ${{ number_format($venta->total, 2) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

        <div class="flex justify-between items-center">

            <p class="text-xl font-bold">
                Total: ${{ number_format($total, 2) }}
            </p>

            @can('update', $ventaBase)
            <form action="{{ route('ventas.validar', $ventaBase) }}" method="POST" onsubmit="return confirm('¿Registrar esta compra?')">
                @csrf
                @method('PATCH')

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Registrar venta
                </button>
            </form>
            @endcan

        </div>

    </div>

    @empty

    <div class="bg-white shadow rounded p-6 text-center">
        <p class="text-gray-500">
            No tienes ventas pendientes por registrar.
        </p>
    </div>

    @endforelse

</div>

@endsection