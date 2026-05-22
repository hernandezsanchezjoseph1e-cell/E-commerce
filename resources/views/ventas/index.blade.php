@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <div class="flex justify-between mb-6">

        <h1 class="text-2xl font-bold">Ventas registradas</h1>

        @if(auth()->user()->role === 'gerente')
        <a href="{{ route('ventas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            Ventas pendientes
        </a>
        @endif

    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @php
    $ventasAgrupadas = $ventas->groupBy(function ($venta) {
    return $venta->referencia_pago ?? 'SIN_REFERENCIA_' . $venta->id;
    });
    @endphp

    <table class="w-full border">

        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Referencia</th>
                <th class="p-2">Productos</th>
                <th class="p-2">Cliente</th>
                <th class="p-2">Vendedor</th>
                <th class="p-2">Fecha</th>
                <th class="p-2">Total</th>
                <th class="p-2">Estado</th>
            </tr>
        </thead>

        <tbody>

            @forelse($ventasAgrupadas as $referencia => $grupoVentas)

            @php
            $ventaBase = $grupoVentas->first();
            $total = $grupoVentas->sum('total');
            @endphp

            <tr class="border-t">

                <td class="p-2 font-semibold">
                    {{ $ventaBase->referencia_pago ?? 'Sin referencia' }}
                </td>

                <td class="p-2">
                    @foreach($grupoVentas as $venta)
                    <div class="mb-1">
                        <div>
                            {{ $venta->producto->nombre }}
                            x{{ $venta->cantidad }}
                        </div>

                        <div class="text-sm text-gray-500">
                            ${{ number_format($venta->total, 2) }}
                        </div>
                    </div>
                    @endforeach
                </td>

                <td class="p-2">
                    {{ $ventaBase->cliente->nombre }} {{ $ventaBase->cliente->apellidos }}
                </td>

                <td class="p-2">
                    {{ $ventaBase->vendedor->nombre }} {{ $ventaBase->vendedor->apellidos }}
                </td>

                <td class="p-2">
                    {{ $ventaBase->fecha->format('d/m/Y') }}
                </td>

                <td class="p-2 font-semibold">
                    ${{ number_format($total, 2) }}
                </td>

                <td class="p-2">
                    @if($grupoVentas->every(fn($venta) => $venta->validada))
                    <span class="text-green-700 font-bold">
                        ✔ Registrada
                    </span>
                    @else
                    <span class="text-yellow-700 font-bold">
                        Pendiente
                    </span>
                    @endif
                </td>

            </tr>

            @empty

            <tr>
                <td colspan="7" class="p-4 text-center text-gray-500">
                    No hay ventas registradas.
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection