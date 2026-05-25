@extends('layouts.app')

@section('title', 'Mi carrito | Tech & Home')

@section('content')

<div class="space-y-8">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">
                Compra
            </p>

            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
                Mi carrito
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Revisa tus productos antes de confirmar la compra.
            </p>
        </div>

        <a href="{{ route('dashboard.cliente') }}" class="btn-secondary w-full sm:w-auto">
            Seguir comprando
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

    @if($productos->isEmpty())

    <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="px-6 py-12 text-center sm:px-8">

            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.5h2.25l2.25 10.5h8.25l2.25-7.5H7.5M9 19.5h.01M17.25 19.5h.01" />
                </svg>
            </div>

            <h2 class="mt-5 text-xl font-bold text-slate-900">
                Tu carrito está vacío
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Explora el catálogo y agrega productos para iniciar tu compra.
            </p>

            <div class="mt-6">
                <a href="{{ route('dashboard.cliente') }}" class="btn-primary">
                    Ver productos
                </a>
            </div>

        </div>
    </section>

    @else

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_380px]">

        <section class="space-y-4">

            @foreach($productos as $producto)

            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-[112px_1fr] sm:p-6">

                    <div>
                        @php
                        $fotoProducto = is_array($producto->fotos) ? ($producto->fotos[0] ?? null) : null;
                        @endphp

                        @if($fotoProducto)
                        <img src="{{ asset('storage/' . $fotoProducto) }}" alt="{{ $producto->nombre }}" class="h-32 w-full rounded-2xl object-cover sm:h-28 sm:w-28">
                        @else
                        <div class="flex h-32 w-full items-center justify-center rounded-2xl bg-slate-100 text-xs font-medium text-slate-400 sm:h-28 sm:w-28">
                            Sin imagen
                        </div>
                        @endif
                    </div>

                    <div class="min-w-0">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                            <div>
                                <h2 class="text-lg font-bold text-slate-900">
                                    {{ $producto->nombre }}
                                </h2>

                                <p class="mt-1 text-sm text-slate-500">
                                    Vendedor: {{ $producto->usuario->nombre ?? 'N/A' }}
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    Stock disponible: {{ $producto->existencia }}
                                </p>
                            </div>

                            <div class="sm:text-right">
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Precio
                                </p>

                                <p class="mt-1 text-lg font-bold text-slate-900">
                                    ${{ number_format($producto->precio, 2) }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 grid grid-cols-1 gap-4 border-t border-slate-100 pt-5 xl:grid-cols-[1fr_auto_auto] xl:items-center">

                            <form action="{{ route('carrito.actualizar', $producto) }}" method="POST" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                                @csrf
                                @method('PATCH')

                                <label for="cantidad-{{ $producto->id }}" class="text-sm font-semibold text-slate-700">
                                    Cantidad
                                </label>

                                <input id="cantidad-{{ $producto->id }}" type="number" name="cantidad" min="1" max="{{ $producto->existencia }}" value="{{ $producto->cantidad_carrito }}" class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-center text-sm font-semibold text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:w-24">

                                <button type="submit" class="btn-muted">
                                    Actualizar
                                </button>
                            </form>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Subtotal
                                </p>

                                <p class="mt-1 text-lg font-bold text-slate-900">
                                    ${{ number_format($producto->subtotal_carrito, 2) }}
                                </p>
                            </div>

                            <button type="button"
                                data-confirm-button
                                data-confirm-title="Eliminar producto"
                                data-confirm-message="¿Seguro que deseas eliminar este producto del carrito?"
                                data-confirm-action="{{ route('carrito.eliminar', $producto) }}"
                                data-confirm-method="DELETE"
                                data-confirm-text="Eliminar"
                                data-confirm-variant="danger"
                                class="btn-danger w-full xl:w-auto">
                                Eliminar
                            </button>

                        </div>

                    </div>

                </div>

            </article>

            @endforeach

        </section>

        <aside class="lg:sticky lg:top-6 lg:self-start">

            <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                    <h2 class="text-lg font-bold text-slate-900">
                        Resumen de compra
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Selecciona el método de pago para continuar.
                    </p>
                </div>

                <div class="space-y-5 p-5 sm:p-6">

                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-4">
                        <span class="text-sm font-semibold text-slate-600">
                            Total
                        </span>

                        <span class="text-2xl font-bold text-emerald-700">
                            ${{ number_format($total, 2) }}
                        </span>
                    </div>

                    <form action="{{ route('carrito.comprar') }}" method="POST" class="space-y-5" novalidate>
                        @csrf

                        <div>
                            <label for="metodo_pago" class="form-label">
                                Método de pago
                            </label>

                            <select id="metodo_pago" name="metodo_pago" class="form-select">
                                <option value="">Seleccione un método de pago</option>

                                <option value="oxxo" {{ old('metodo_pago') === 'oxxo' ? 'selected' : '' }}>
                                    Pago en punto de venta / OXXO
                                </option>

                                <option value="transferencia" {{ old('metodo_pago') === 'transferencia' ? 'selected' : '' }}>
                                    Transferencia bancaria
                                </option>

                                <option value="tarjeta" {{ old('metodo_pago') === 'tarjeta' ? 'selected' : '' }}>
                                    Tarjeta de crédito/débito
                                </option>
                            </select>

                            @error('metodo_pago')
                            <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            Confirmar compra
                        </button>
                    </form>

                    <button type="button"
                        data-confirm-button
                        data-confirm-title="Vaciar carrito"
                        data-confirm-message="¿Seguro que deseas eliminar todos los productos del carrito?"
                        data-confirm-action="{{ route('carrito.vaciar') }}"
                        data-confirm-method="DELETE"
                        data-confirm-text="Vaciar carrito"
                        data-confirm-variant="danger"
                        class="btn-secondary w-full">
                        Vaciar carrito
                    </button>

                </div>

            </section>

        </aside>

    </div>

    @endif

</div>

@endsection