@extends('layouts.app')

@section('title', 'Ventas registradas | Tech & Home')

@section('content')

<div class="app-page">

    <div class="page-header">
        <div>
            <p class="page-kicker">
                {{ auth()->user()->role === 'administrador' ? 'Administración' : 'Gerencia' }}
            </p>

            <h1 class="page-title">
                Ventas registradas
            </h1>

            <p class="page-description">
                Consulta las ventas confirmadas y agrupadas por referencia de pago.
            </p>
        </div>

        @if(auth()->user()->role === 'gerente')
        <a href="{{ route('ventas.create') }}" class="btn-primary w-full sm:w-auto">
            Ventas pendientes
        </a>
        @endif
    </div>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <section class="table-wrapper">

        <div class="card-header">
            <h2 class="card-title">
                Historial de ventas
            </h2>

            <p class="card-description">
                Cada fila representa una compra agrupada por referencia de pago.
            </p>
        </div>

        <div class="table-scroll">
            <table class="data-table-lg">
                <thead class="data-thead">
                    <tr>
                        <th class="data-th">Referencia</th>
                        <th class="data-th">Productos</th>
                        <th class="data-th">Cliente</th>
                        <th class="data-th">Vendedor</th>
                        <th class="data-th">Fecha</th>
                        <th class="data-th">Total</th>
                        <th class="data-th">Estado</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($ventasAgrupadas as $grupo)
                    <tr class="data-row">
                        <td class="data-td">
                            <span class="font-mono text-sm font-semibold text-slate-900">
                                {{ $grupo['venta_base']->referencia_pago ?? 'Sin referencia' }}
                            </span>
                        </td>

                        <td class="data-td">
                            <div class="space-y-3">
                                @foreach($grupo['ventas'] as $venta)
                                <div>
                                    <p class="font-medium text-slate-900">
                                        {{ $venta->producto->nombre }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Cantidad: {{ $venta->cantidad }} · ${{ number_format($venta->total, 2) }}
                                    </p>
                                </div>
                                @endforeach
                            </div>
                        </td>

                        <td class="data-td">
                            <p class="font-medium text-slate-900">
                                {{ $grupo['venta_base']->cliente->nombre }} {{ $grupo['venta_base']->cliente->apellidos }}
                            </p>
                        </td>

                        <td class="data-td">
                            <p class="font-medium text-slate-900">
                                {{ $grupo['venta_base']->vendedor->nombre }} {{ $grupo['venta_base']->vendedor->apellidos }}
                            </p>
                        </td>

                        <td class="data-td">
                            {{ $grupo['venta_base']->fecha->format('d/m/Y') }}
                        </td>

                        <td class="data-td-strong">
                            ${{ number_format($grupo['total'], 2) }}
                        </td>

                        <td class="data-td">
                            @if($grupo['registrada'])
                            <span class="badge-success">
                                Registrada
                            </span>
                            @else
                            <span class="badge-warning">
                                Pendiente
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="table-empty">
                            No hay ventas registradas.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </section>

</div>

@endsection