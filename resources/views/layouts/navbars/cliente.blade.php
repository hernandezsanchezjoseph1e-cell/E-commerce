@extends('layouts.navbars.navbar')

@section('menu')

<a href="{{ route('dashboard.cliente') }}" title="Inicio" aria-label="Inicio" class="nav-icon-link {{ request()->routeIs('dashboard.cliente') ? 'nav-icon-link-active' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
        <path stroke-linecap="round" stroke-linejoin="round" d="m3 11.25 9-7.5 9 7.5M5.25 10.5v9.75h13.5V10.5" />
    </svg>

    <span class="nav-icon-label">Inicio</span>
    <span class="nav-tooltip">Inicio</span>
</a>

<a href="{{ route('carrito.index') }}" title="Carrito" aria-label="Carrito" class="nav-icon-link {{ request()->routeIs('carrito.*') ? 'nav-icon-link-active' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.5h2.25l2.25 10.5h8.25l2.25-7.5H7.5M9 19.5h.01M17.25 19.5h.01" />
    </svg>

    <span class="nav-icon-label">Carrito</span>

    @if(($cantidadCarrito ?? 0) > 0)
    <span class="nav-badge">
        {{ $cantidadCarrito }}
    </span>
    @endif

    <span class="nav-tooltip">Carrito</span>
</a>

<a href="{{ route('cliente.ventas.index') }}" title="Mis compras" aria-label="Mis compras" class="nav-icon-link {{ request()->routeIs('cliente.ventas.*') ? 'nav-icon-link-active' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6V4.875a4.5 4.5 0 1 0-9 0V6M4.875 6h14.25l-.75 11.25a2.25 2.25 0 0 1-2.244 2.1H7.869a2.25 2.25 0 0 1-2.244-2.1L4.875 6Z" />
    </svg>

    <span class="nav-icon-label">Mis compras</span>
    <span class="nav-tooltip">Mis compras</span>
</a>

@endsection