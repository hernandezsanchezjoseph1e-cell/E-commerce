@extends('layouts.app')

@section('title', 'Dashboard Gerente | Tech & Home')

@section('content')

<div class="app-page">

    <div class="page-header-simple">
        <p class="page-kicker">
            Panel de vendedor
        </p>

        <div>
            <h1 class="page-title">
                Bienvenido, {{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}
            </h1>

            <p class="page-description">
                Gestiona tus productos, categorías y ventas pendientes dentro del sistema.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

        <a href="{{ route('productos.index') }}" class="card card-body transition hover:border-emerald-200 hover:shadow-md">
            <p class="text-sm font-medium text-slate-500">
                Productos
            </p>

            <h2 class="mt-2 text-xl font-bold text-slate-900">
                Gestionar productos
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Consulta, registra y administra los productos que vendes.
            </p>
        </a>

        <a href="{{ route('categorias.index') }}" class="card card-body transition hover:border-emerald-200 hover:shadow-md">
            <p class="text-sm font-medium text-slate-500">
                Categorías
            </p>

            <h2 class="mt-2 text-xl font-bold text-slate-900">
                Gestionar categorías
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Organiza los productos por categorías para mejorar su clasificación.
            </p>
        </a>

        <a href="{{ route('ventas.create') }}" class="card card-body transition hover:border-emerald-200 hover:shadow-md">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Ventas
                    </p>

                    <h2 class="mt-2 text-xl font-bold text-slate-900">
                        Ventas pendientes
                    </h2>
                </div>

                @if($ventasPendientes > 0)
                <span class="badge-danger">
                    {{ $ventasPendientes }}
                </span>
                @endif
            </div>

            <p class="mt-2 text-sm text-slate-500">
                Revisa las compras pendientes de validación y registra los pagos confirmados.
            </p>
        </a>

    </div>

</div>

@endsection