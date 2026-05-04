@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Mis Compras</h1>

    @forelse($ventas as $venta)

    <div class="border rounded p-4 mb-4 shadow">

        <p><strong>Producto:</strong> {{ $venta->producto->nombre }}</p>
        <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
        <p><strong>Total:</strong> ${{ $venta->total }}</p>

        <div class="mt-3">

            @if($venta->ticket)
            @can('view', $venta)
            <a href="{{ route('ventas.ticket', $venta) }}"
                class="bg-blue-500 text-white px-3 py-1 rounded">
                Ver ticket
            </a>
            @endcan
            @else
            <span class="text-gray-500">Sin ticket</span>
            @endif

        </div>

    </div>

    @empty
    <p class="text-gray-500">No tienes compras registradas.</p>
    @endforelse

</div>

@endsection