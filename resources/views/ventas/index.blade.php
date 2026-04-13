@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <div class="flex justify-between mb-6">

        <h1 class="text-2xl font-bold">Ventas</h1>

        @if(auth()->user()->role === 'gerente')
        <a href="{{ route('ventas.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded">
            Nuevo Venta
        </a>
        @endif

    </div>

    <table class="w-full border">

        <thead class="bg-gray-200">

            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Producto</th>
                <th class="p-2">Cliente</th>
                <th class="p-2">Vendedor</th>
                <th class="p-2">Fecha</th>
                <th class="p-2">Total</th>
            </tr>

        </thead>

        <tbody>

            @foreach($ventas as $venta)

            <tr class="border-t">

                <td class="p-2">{{ $venta->id }}</td>

                <td class="p-2">{{ $venta->producto->nombre }}</td>

                <td class="p-2">{{ $venta->cliente->nombre }}</td>

                <td class="p-2">{{ $venta->vendedor->nombre }}</td>

                <td class="p-2">{{ $venta->fecha }}</td>

                <td class="p-2">${{ $venta->total }}</td>
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection