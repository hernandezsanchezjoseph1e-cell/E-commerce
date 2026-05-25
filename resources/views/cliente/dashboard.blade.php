@extends('layouts.app')

@section('title', 'Inicio | Tech & Home')

@section('content')

<div class="space-y-8">

    <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="grid grid-cols-1 gap-6 p-6 sm:p-8 lg:grid-cols-[1.4fr_0.6fr] lg:items-center">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">
                    Tienda en línea
                </p>

                <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                    Bienvenido, {{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}
                </h1>

                <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-500 sm:text-base">
                    Explora productos de tecnología y hogar, agrega artículos al carrito y consulta el estado de tus compras desde un solo lugar.
                </p>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('carrito.index') }}" class="btn-primary w-full sm:w-auto">
                        Ver carrito
                    </a>

                    <a href="{{ route('cliente.ventas.index') }}" class="btn-secondary w-full sm:w-auto">
                        Mis compras
                    </a>
                </div>
            </div>

            <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-5">
                <p class="text-sm font-semibold text-emerald-800">
                    Compra segura
                </p>

                <p class="mt-2 text-sm leading-6 text-emerald-700">
                    Los productos se agrupan por vendedor para mantener el proceso de compra claro y ordenado.
                </p>

                <div class="mt-5 rounded-xl bg-white p-4 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Categorías disponibles
                    </p>

                    <p class="mt-1 text-3xl font-bold text-slate-900">
                        {{ $categorias->count() }}
                    </p>
                </div>
            </div>

        </div>
    </section>

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

    <section class="space-y-5">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">
                    Catálogo
                </p>

                <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                    Productos disponibles
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Explora el catálogo por categoría y agrega productos disponibles a tu carrito.
                </p>
            </div>
        </div>

        <div class="space-y-8">
            @forelse($categorias as $categoria)
            @include('cliente.components.categoria', ['categoria' => $categoria])
            @empty
            <section class="card card-body text-center">
                <p class="text-sm font-medium text-slate-600">
                    No hay productos disponibles por el momento.
                </p>

                <p class="mt-1 text-sm text-slate-400">
                    Vuelve más tarde para consultar nuevos productos.
                </p>
            </section>
            @endforelse
        </div>
    </section>

</div>

@endsection