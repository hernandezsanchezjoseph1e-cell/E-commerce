<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comprobante de pago | Tech & Home</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .print-card {
                box-shadow: none !important;
                border: none !important;
            }
        }
    </style>
</head>

<body class="bg-slate-100 font-sans text-slate-900">

    @php
    $ventaBase = $ventas->first();
    @endphp

    <main class="min-h-screen px-4 py-8 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-3xl">

            <div class="no-print mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('cliente.ventas.index') }}" class="btn-secondary w-full sm:w-auto">
                    Volver a mis compras
                </a>

                <button onclick="window.print()" class="btn-primary w-full sm:w-auto">
                    Imprimir / guardar PDF
                </button>
            </div>

            <section class="print-card overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-6 py-5">
                    <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">
                        Tech & Home
                    </p>

                    <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                        Comprobante de pago
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Presenta esta información para realizar o identificar tu pago.
                    </p>
                </div>

                <div class="space-y-6 px-6 py-6">

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Referencia de pago
                            </p>

                            <p class="mt-2 font-mono text-xl font-bold tracking-wide text-slate-900">
                                {{ $referencia }}
                            </p>
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Código de pago
                            </p>

                            <p class="mt-2 font-mono text-xl font-bold tracking-wide text-slate-900">
                                {{ $ventaBase->codigo_pago ?? 'Sin código' }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200 px-4 py-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Cliente
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-900">
                                {{ $ventaBase->cliente->nombre }} {{ $ventaBase->cliente->apellidos }}
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                {{ $ventaBase->cliente->email }}
                            </p>
                        </div>

                        <div class="rounded-2xl border border-slate-200 px-4 py-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Vendedor
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-900">
                                {{ $ventaBase->vendedor->nombre }} {{ $ventaBase->vendedor->apellidos }}
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                {{ $ventaBase->vendedor->email }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-lg font-bold text-slate-900">
                            Resumen de compra
                        </h2>

                        <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200">
                            <table class="w-full border-collapse">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                            Producto
                                        </th>

                                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">
                                            Cantidad
                                        </th>

                                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                                            Precio
                                        </th>

                                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                                            Subtotal
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-slate-100 bg-white">
                                    @foreach($ventas as $venta)
                                    <tr>
                                        <td class="px-4 py-3 text-sm font-medium text-slate-900">
                                            {{ $venta->producto->nombre }}
                                        </td>

                                        <td class="px-4 py-3 text-center text-sm text-slate-600">
                                            {{ $venta->cantidad }}
                                        </td>

                                        <td class="px-4 py-3 text-right text-sm text-slate-600">
                                            ${{ number_format($venta->producto->precio, 2) }}
                                        </td>

                                        <td class="px-4 py-3 text-right text-sm font-semibold text-slate-900">
                                            ${{ number_format($venta->total, 2) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4">
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm font-semibold text-slate-600">
                                Total a pagar
                            </span>

                            <span class="text-2xl font-bold text-emerald-700">
                                ${{ number_format($total, 2) }}
                            </span>
                        </div>

                        <div class="mt-4 grid grid-cols-1 gap-3 border-t border-slate-200 pt-4 sm:grid-cols-2">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Fecha límite
                                </p>

                                <p class="mt-1 text-sm font-semibold text-slate-800">
                                    {{ $ventaBase->fecha_limite_pago->format('d/m/Y H:i') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Método de pago
                                </p>

                                <p class="mt-1 text-sm font-semibold uppercase text-slate-800">
                                    {{ $ventaBase->metodo_pago ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <p class="text-center text-xs text-slate-400">
                        Este comprobante fue generado automáticamente por Tech & Home.
                    </p>

                </div>

            </section>

        </div>

    </main>

</body>

</html>