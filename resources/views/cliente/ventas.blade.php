@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Mis compras</h1>

    @php
    $comprasAgrupadas = $ventas->groupBy(function ($venta) {
    return $venta->referencia_pago ?? 'SIN_REFERENCIA_' . $venta->id;
    });
    @endphp

    @forelse($comprasAgrupadas as $referencia => $grupoVentas)

    @php
    $ventaBase = $grupoVentas->first();
    $total = $grupoVentas->sum('total');
    @endphp

    <div class="border rounded p-4 mb-4 shadow bg-white">

        <div class="flex justify-between items-start mb-3">

            <div>
                <h2 class="font-bold text-lg">
                    Compra {{ $ventaBase->referencia_pago ?? '#' . $ventaBase->id }}
                </h2>

                <p class="text-sm text-gray-500">
                    Fecha: {{ $ventaBase->fecha->format('d/m/Y') }}
                </p>
            </div>

            @if($grupoVentas->every(fn($venta) => $venta->validada))
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded text-sm font-semibold">
                Registrada
            </span>
            @else
            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-sm font-semibold">
                Pendiente
            </span>
            @endif

        </div>

        <div class="mb-3">

            <p>
                <strong>Vendedor:</strong>
                {{ $ventaBase->vendedor->nombre }} {{ $ventaBase->vendedor->apellidos }}
            </p>

            <p>
                <strong>Método de pago:</strong>
                {{ strtoupper($ventaBase->metodo_pago ?? 'No especificado') }}
            </p>

            <p>
                <strong>Código de pago:</strong>
                {{ $ventaBase->codigo_pago ?? 'Sin código' }}
            </p>

        </div>

        <p><strong>Productos:</strong></p>

        <ul class="list-disc ml-6 mb-3">
            @foreach($grupoVentas as $venta)
            <li>
                {{ $venta->producto->nombre }}
                x{{ $venta->cantidad }}
                — ${{ number_format($venta->total, 2) }}
            </li>
            @endforeach
        </ul>

        <p class="font-bold">
            Total: ${{ number_format($total, 2) }}
        </p>

        <div class="mt-3">
            <a href="{{ route('carrito.comprobante', $ventaBase->referencia_pago) }}" class="bg-blue-500 text-white px-3 py-1 rounded">
                Ver comprobante
            </a>
        </div>

    </div>

    @empty

    <p class="text-gray-500">No tienes compras registradas.</p>

    @endforelse

</div>

@endsection