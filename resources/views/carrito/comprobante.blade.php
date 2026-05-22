@extends('layouts.app')

@section('title', 'Comprobante de pago')

@section('content')

<div class="container mx-auto p-6">

    <div class="max-w-2xl mx-auto bg-white shadow rounded p-6">

        <h1 class="text-2xl font-bold text-gray-800 mb-2">
            Comprobante de pago
        </h1>

        <p class="text-gray-600 mb-6">
            Presenta esta referencia para realizar tu pago.
        </p>

        <div class="border rounded p-4 mb-6 bg-gray-50">

            <p class="text-sm text-gray-500">Referencia</p>

            <p class="text-2xl font-bold tracking-wider">
                {{ $referencia }}
            </p>

        </div>

        <div class="border rounded p-4 mb-6 text-center">

            <p class="text-sm text-gray-500 mb-2">
                Código de pago
            </p>

            @php
            $codigoPago = (string) $ventas->first()->codigo_pago;
            @endphp

            <div class="text-3xl font-bold tracking-widest mb-2">
                {{ $codigoPago }}
            </div>

            <div class="h-20 flex items-end justify-center gap-1 mb-2">
                @foreach(str_split($codigoPago) as $numero)
                @php
                $ancho = 2 + ((int) $numero % 4);
                $alto = 35 + ((int) $numero * 4);
                $estiloBarra = "width: {$ancho}px; height: {$alto}px;";
                @endphp

                <div class="bg-black" style="{{ $estiloBarra }}"></div>
                @endforeach
            </div>

            <p class="text-xs text-gray-500">
                Código generado por el sistema para referencia interna.
            </p>

        </div>

        <div class="mb-6">

            <h2 class="font-bold text-lg mb-3">
                Resumen de compra
            </h2>

            <div class="border rounded p-4 mb-3">

                <p class="font-semibold mb-4">
                    Vendedor:
                    {{ $ventas->first()->vendedor->nombre }}
                    {{ $ventas->first()->vendedor->apellidos }}
                </p>

                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Producto</th>
                            <th class="p-2 text-center">Cantidad</th>
                            <th class="p-2 text-right">Precio unitario</th>
                            <th class="p-2 text-right">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($ventas as $venta)
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

        </div>

        <div class="border-t pt-4 mb-6">

            <p class="flex justify-between text-lg">
                <span>Total a pagar:</span>
                <strong>${{ number_format($total, 2) }}</strong>
            </p>

            <p class="flex justify-between text-sm text-gray-600 mt-2">
                <span>Fecha límite:</span>
                <span>{{ $ventas->first()->fecha_limite_pago->format('d/m/Y H:i') }}</span>
            </p>

            <p class="flex justify-between text-sm text-gray-600 mt-1">
                <span>Método de pago:</span>
                <span>{{ strtoupper($ventas->first()->metodo_pago) }}</span>
            </p>

        </div>

        <div class="flex gap-3">

            <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Descargar / imprimir comprobante
            </button>

            <a href="{{ route('cliente.ventas.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded">
                Ver mis compras
            </a>

        </div>

    </div>

</div>

@endsection