@extends('layouts.app')

@section('title', 'Ventas pendientes | Tech & Home')

@section('content')

<div class="app-page">

    <div class="page-header">
        <div>
            <p class="page-kicker">
                Gerencia
            </p>

            <h1 class="page-title">
                Ventas pendientes
            </h1>

            <p class="page-description">
                Revisa las compras pendientes de validación y registra las ventas confirmadas.
            </p>
        </div>

        <a href="{{ route('ventas.index') }}" class="btn-secondary w-full sm:w-auto">
            Ver ventas registradas
        </a>
    </div>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert-danger">
        <p class="font-semibold">
            Revisa los siguientes mensajes:
        </p>

        <ul class="mt-2 list-inside list-disc space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="space-y-5">

        @forelse($ventas as $referencia => $grupoVentas)

        @php
        $ventaBase = $grupoVentas->first();
        $total = $grupoVentas->sum('total');
        @endphp

        <section class="card overflow-hidden">

            <div class="card-header">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h2 class="card-title">
                            Compra {{ $referencia }}
                        </h2>

                        <p class="card-description">
                            Fecha: {{ $ventaBase->fecha->format('d/m/Y') }}
                        </p>
                    </div>

                    <span class="badge-warning w-fit">
                        Pendiente
                    </span>
                </div>
            </div>

            <div class="card-body space-y-5">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

                    <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Cliente
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-900">
                            {{ $ventaBase->cliente->nombre }} {{ $ventaBase->cliente->apellidos }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            {{ $ventaBase->cliente->email }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Método de pago
                        </p>

                        <p class="mt-1 text-sm font-semibold uppercase text-slate-900">
                            {{ $ventaBase->metodo_pago ?? 'No especificado' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Referencia
                        </p>

                        <p class="mt-1 font-mono text-sm font-semibold text-slate-900">
                            {{ $ventaBase->referencia_pago ?? 'Sin referencia' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Código de pago
                        </p>

                        <p class="mt-1 font-mono text-sm font-semibold text-slate-900">
                            {{ $ventaBase->codigo_pago ?? 'Sin código' }}
                        </p>
                    </div>

                </div>

                <div class="overflow-hidden rounded-xl border border-slate-200">
                    <div class="table-scroll">
                        <table class="data-table">
                            <thead class="data-thead">
                                <tr>
                                    <th class="data-th">Producto</th>
                                    <th class="data-th">Cantidad</th>
                                    <th class="data-th">Precio</th>
                                    <th class="data-th">Subtotal</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100 bg-white">
                                @foreach($grupoVentas as $venta)
                                <tr class="data-row">
                                    <td class="data-td-strong">
                                        {{ $venta->producto->nombre }}
                                    </td>

                                    <td class="data-td">
                                        {{ $venta->cantidad }}
                                    </td>

                                    <td class="data-td">
                                        ${{ number_format($venta->producto->precio, 2) }}
                                    </td>

                                    <td class="data-td-strong">
                                        ${{ number_format($venta->total, 2) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-xl font-bold text-slate-900">
                        Total: ${{ number_format($total, 2) }}
                    </p>

                    @can('update', $ventaBase)
                    <button type="button"
                        data-confirm-button
                        data-confirm-title="Registrar venta"
                        data-confirm-message="¿Confirmas que deseas registrar esta compra como pagada? Esta acción validará la referencia {{ $ventaBase->referencia_pago ?? $referencia }}."
                        data-confirm-action="{{ route('ventas.validar', $ventaBase) }}"
                        data-confirm-method="PATCH"
                        data-confirm-text="Registrar venta"
                        data-confirm-variant="success"
                        class="btn-success w-full sm:w-auto">
                        Registrar venta
                    </button>
                    @endcan
                </div>
            </div>

        </section>

        @empty

        <section class="card card-body text-center">
            <p class="text-sm font-medium text-slate-600">
                No tienes ventas pendientes por registrar.
            </p>

            <p class="mt-1 text-sm text-slate-400">
                Cuando un cliente confirme una compra, aparecerá en esta sección.
            </p>
        </section>

        @endforelse

    </div>

</div>

@endsection