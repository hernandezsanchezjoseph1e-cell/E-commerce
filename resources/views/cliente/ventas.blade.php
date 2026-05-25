@extends('layouts.app')

@section('title', 'Mis compras | Tech & Home')

@section('content')

<div class="space-y-8">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">
                Historial
            </p>

            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
                Mis compras
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Consulta el estado de tus compras, referencias de pago y comprobantes generados.
            </p>
        </div>

        <a href="{{ route('dashboard.cliente') }}" class="btn-secondary w-full sm:w-auto">
            Seguir comprando
        </a>
    </div>

    <div class="space-y-5">

        @forelse($ventasAgrupadas as $grupo)

        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Referencia
                        </p>

                        <h2 class="mt-1 font-mono text-lg font-bold text-slate-900">
                            {{ $grupo['venta_base']->referencia_pago ?? '#' . $grupo['venta_base']->id }}
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Compra realizada el {{ $grupo['venta_base']->fecha->format('d/m/Y') }}
                        </p>
                    </div>

                    @if($grupo['registrada'])
                    <span class="badge-success w-fit">
                        Registrada
                    </span>
                    @else
                    <span class="badge-warning w-fit">
                        Pendiente
                    </span>
                    @endif

                </div>
            </div>

            <div class="space-y-5 p-5 sm:p-6">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Vendedor
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-900">
                            {{ $grupo['venta_base']->vendedor->nombre }} {{ $grupo['venta_base']->vendedor->apellidos }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Método de pago
                        </p>

                        <p class="mt-1 text-sm font-semibold uppercase text-slate-900">
                            {{ $grupo['venta_base']->metodo_pago ?? 'No especificado' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Código de pago
                        </p>

                        <p class="mt-1 font-mono text-sm font-semibold text-slate-900">
                            {{ $grupo['venta_base']->codigo_pago ?? 'Sin código' }}
                        </p>
                    </div>

                </div>

                <div class="space-y-3">
                    <h3 class="text-sm font-bold text-slate-900">
                        Productos comprados
                    </h3>

                    <div class="divide-y divide-slate-100 rounded-2xl border border-slate-200">
                        @foreach($grupo['ventas'] as $venta)
                        <div class="flex flex-col gap-3 px-4 py-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>
                                <p class="font-semibold text-slate-900">
                                    {{ $venta->producto->nombre }}
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    Cantidad: {{ $venta->cantidad }}
                                </p>
                            </div>

                            <p class="text-base font-bold text-slate-900 sm:text-right">
                                ${{ number_format($venta->total, 2) }}
                            </p>

                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="border-t border-slate-200 bg-slate-50 px-5 py-4 sm:px-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Total de compra
                        </p>

                        <p class="mt-1 text-2xl font-bold text-emerald-700">
                            ${{ number_format($grupo['total'], 2) }}
                        </p>
                    </div>

                    @if($grupo['venta_base']->referencia_pago)
                    <a href="{{ route('carrito.comprobante', $grupo['venta_base']->referencia_pago) }}" class="btn-primary w-full sm:w-auto">
                        Ver comprobante
                    </a>
                    @endif

                </div>
            </div>

        </section>

        @empty

        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="px-6 py-12 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6V4.875a4.5 4.5 0 1 0-9 0V6M4.875 6h14.25l-.75 11.25a2.25 2.25 0 0 1-2.244 2.1H7.869a2.25 2.25 0 0 1-2.244-2.1L4.875 6Z" />
                    </svg>
                </div>

                <h2 class="mt-5 text-xl font-bold text-slate-900">
                    No tienes compras registradas
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    Cuando confirmes una compra, aparecerá en esta sección.
                </p>

                <div class="mt-6">
                    <a href="{{ route('dashboard.cliente') }}" class="btn-primary">
                        Explorar productos
                    </a>
                </div>

            </div>
        </section>

        @endforelse

    </div>

</div>

@endsection