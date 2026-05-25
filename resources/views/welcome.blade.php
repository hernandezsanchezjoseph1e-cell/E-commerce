@extends('layouts.public')

@section('title', 'Tech & Home | Tecnología para tu hogar')

@section('content')

{{-- HERO --}}
<section class="relative overflow-hidden bg-white">
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 via-white to-orange-50"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-24 sm:py-28 lg:px-8">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">
                    Tech & Home
                </p>

                <h1 class="mt-4 max-w-3xl text-4xl font-bold tracking-tight text-slate-950 sm:text-5xl lg:text-6xl">
                    Tecnología útil para hacer tu hogar más cómodo.
                </h1>

                <p class="mt-6 max-w-2xl text-base leading-7 text-slate-600 sm:text-lg">
                    Encuentra productos de tecnología, accesorios y soluciones para el hogar. Compra de forma clara, organizada y con referencias de pago por vendedor.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#productos" class="btn-primary w-full sm:w-auto">
                        Ver productos
                    </a>

                    @guest
                    <a href="{{ route('login') }}" class="btn-secondary w-full sm:w-auto">
                        Iniciar sesión
                    </a>
                    @else
                    <a href="{{ route('dashboard.cliente') }}" class="btn-secondary w-full sm:w-auto">
                        Ir a mi cuenta
                    </a>
                    @endguest
                </div>
            </div>

            <div class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-xl">
                <div class="rounded-[1.5rem] bg-slate-950 p-6 text-white">
                    <p class="text-sm font-semibold text-emerald-300">
                        Compra simplificada
                    </p>

                    <h2 class="mt-3 text-2xl font-bold">
                        Un carrito, un vendedor, una referencia.
                    </h2>

                    <p class="mt-4 text-sm leading-6 text-slate-300">
                        Para mantener el proceso claro, cada compra agrupa productos de un mismo vendedor y genera una referencia de pago.
                    </p>

                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <div class="rounded-2xl bg-white/10 p-4">
                            <p class="text-3xl font-bold">
                                24/7
                            </p>

                            <p class="mt-1 text-xs text-slate-300">
                                Catálogo disponible
                            </p>
                        </div>

                        <div class="rounded-2xl bg-white/10 p-4">
                            <p class="text-3xl font-bold">
                                1
                            </p>

                            <p class="mt-1 text-xs text-slate-300">
                                Referencia por compra
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- BENEFICIOS --}}
<section class="max-w-7xl mx-auto px-6 py-16 lg:px-8">
    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5 12 3 3.75 7.5m16.5 0L12 12m8.25-4.5v9L12 21m0-9L3.75 7.5M12 12v9m0-9L3.75 16.5v-9" />
                </svg>
            </div>

            <h2 class="mt-4 text-lg font-bold text-slate-900">
                Productos organizados
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Explora artículos por categoría y revisa disponibilidad antes de agregarlos al carrito.
            </p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-50 text-orange-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3.75h10.5v16.5l-2.25-1.5-2.25 1.5-2.25-1.5-2.25 1.5-2.25-1.5-2.25 1.5V3.75Zm3 5.25h4.5m-4.5 3h4.5m-4.5 3h3" />
                </svg>
            </div>

            <h2 class="mt-4 text-lg font-bold text-slate-900">
                Referencia de pago
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Al confirmar tu compra se genera una referencia para identificar el pago con claridad.
            </p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
                </svg>
            </div>

            <h2 class="mt-4 text-lg font-bold text-slate-900">
                Vendedores identificados
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Cada producto muestra su vendedor para que el proceso de compra sea transparente.
            </p>
        </div>

    </div>
</section>

{{-- PRODUCTOS DESTACADOS --}}
<section id="productos" class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">
                    Catálogo
                </p>

                <h2 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
                    Productos destacados
                </h2>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                    Una selección de productos disponibles para tecnología y hogar.
                </p>
            </div>

            @guest
            <a href="{{ route('login') }}" class="btn-secondary w-full sm:w-auto">
                Comprar ahora
            </a>
            @else
            <a href="{{ route('dashboard.cliente') }}" class="btn-secondary w-full sm:w-auto">
                Ver catálogo completo
            </a>
            @endguest
        </div>

        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @forelse($productosDestacados as $producto)
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-lg">

                <div class="relative bg-slate-100">
                    @php
                    $fotoProducto = is_array($producto->fotos) ? ($producto->fotos[0] ?? null) : null;
                    @endphp

                    @if($fotoProducto)
                    <img src="{{ asset('storage/' . $fotoProducto) }}" alt="{{ $producto->nombre }}" class="h-56 w-full object-cover">
                    @else
                    <div class="flex h-56 w-full items-center justify-center bg-slate-100 text-sm font-medium text-slate-400">
                        Sin imagen
                    </div>
                    @endif

                    <span class="absolute left-4 top-4 rounded-full bg-emerald-600 px-3 py-1 text-xs font-semibold text-white shadow-sm">
                        Disponible
                    </span>
                </div>

                <div class="p-5">
                    <h3 class="line-clamp-2 text-lg font-bold text-slate-900">
                        {{ $producto->nombre }}
                    </h3>

                    <p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-500">
                        {{ $producto->descripcion ?? 'Producto disponible en Tech & Home.' }}
                    </p>

                    <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Vendedor
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-800">
                            {{ $producto->usuario->nombre ?? 'Vendedor' }} {{ $producto->usuario->apellidos ?? '' }}
                        </p>
                    </div>

                    <div class="mt-5 flex items-end justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Precio
                            </p>

                            <p class="mt-1 text-2xl font-bold text-slate-900">
                                ${{ number_format($producto->precio, 2) }}
                            </p>
                        </div>

                        @guest
                        <a href="{{ route('login') }}" class="btn-primary">
                            Iniciar sesión
                        </a>
                        @else
                        <a href="{{ route('dashboard.cliente') }}" class="btn-primary">
                            Ver producto
                        </a>
                        @endguest
                    </div>
                </div>

            </article>
            @empty
            <div class="col-span-full rounded-3xl border border-slate-200 bg-slate-50 px-6 py-12 text-center">
                <p class="text-sm font-medium text-slate-600">
                    Todavía no hay productos destacados.
                </p>

                <p class="mt-1 text-sm text-slate-400">
                    Cuando se registren productos disponibles, aparecerán en esta sección.
                </p>
            </div>
            @endforelse

        </div>

    </div>
</section>

{{-- SOBRE LA TIENDA --}}
<section id="nosotros" class="max-w-7xl mx-auto px-6 py-20 lg:px-8">
    <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:items-center">

        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">
                Sobre la tienda
            </p>

            <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                Un ecommerce práctico para tecnología y hogar.
            </h2>

            <p class="mt-5 text-sm leading-7 text-slate-500 sm:text-base">
                Tech & Home conecta clientes con productos registrados por vendedores dentro del sistema. El flujo está diseñado para mantener compras claras, referencias de pago y seguimiento desde el perfil del cliente.
            </p>
        </div>

        <div class="grid grid-cols-2 gap-5">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 text-center shadow-sm">
                <p class="text-4xl font-bold text-slate-900">
                    {{ $productosDestacados->count() }}+
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    Productos destacados
                </p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 text-center shadow-sm">
                <p class="text-4xl font-bold text-slate-900">
                    3
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    Métodos de pago
                </p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 text-center shadow-sm">
                <p class="text-4xl font-bold text-slate-900">
                    1
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    Vendedor por compra
                </p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 text-center shadow-sm">
                <p class="text-4xl font-bold text-slate-900">
                    24h
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    Acceso al sistema
                </p>
            </div>
        </div>

    </div>
</section>

{{-- CONTACTO --}}
<section id="contacto" class="bg-slate-950 px-6 py-20 text-white">
    <div class="max-w-5xl mx-auto text-center">

        <p class="text-sm font-semibold uppercase tracking-wide text-emerald-300">
            Contacto
        </p>

        <h2 class="mt-2 text-3xl font-bold tracking-tight">
            ¿Listo para explorar Tech & Home?
        </h2>

        <p class="mt-4 text-sm leading-6 text-slate-300">
            Inicia sesión para acceder al catálogo completo, agregar productos al carrito y consultar tus compras.
        </p>

        <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
            @guest
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-slate-100">
                Iniciar sesión
            </a>
            @else
            <a href="{{ route('dashboard.cliente') }}" class="inline-flex items-center justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-slate-100">
                Entrar al catálogo
            </a>
            @endguest
        </div>

    </div>
</section>

@endsection