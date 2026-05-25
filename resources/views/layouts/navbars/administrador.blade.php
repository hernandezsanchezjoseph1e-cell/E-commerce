@extends('layouts.navbars.navbar')

@section('menu')

<a href="{{ route('dashboard.administrador') }}" title="Inicio" aria-label="Inicio" class="nav-icon-link {{ request()->routeIs('dashboard.administrador') ? 'nav-icon-link-active' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
        <path stroke-linecap="round" stroke-linejoin="round" d="m3 11.25 9-7.5 9 7.5M5.25 10.5v9.75h13.5V10.5" />
    </svg>

    <span class="nav-icon-label">Inicio</span>
    <span class="nav-tooltip">Inicio</span>
</a>

<a href="{{ route('usuarios.index') }}" title="Usuarios" aria-label="Usuarios" class="nav-icon-link {{ request()->routeIs('usuarios.*') ? 'nav-icon-link-active' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.75 8.25a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm15 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0ZM4.5 20.25a6.75 6.75 0 0 1 15 0M2.25 18.75a4.5 4.5 0 0 1 5.25-4.5m9 0a4.5 4.5 0 0 1 5.25 4.5" />
    </svg>

    <span class="nav-icon-label">Usuarios</span>
    <span class="nav-tooltip">Usuarios</span>
</a>

<a href="{{ route('productos.index') }}" title="Productos" aria-label="Productos" class="nav-icon-link {{ request()->routeIs('productos.*') ? 'nav-icon-link-active' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5 12 3 3.75 7.5m16.5 0L12 12m8.25-4.5v9L12 21m0-9L3.75 7.5M12 12v9m0-9L3.75 16.5v-9" />
    </svg>

    <span class="nav-icon-label">Productos</span>
    <span class="nav-tooltip">Productos</span>
</a>

<a href="{{ route('categorias.index') }}" title="Categorías" aria-label="Categorías" class="nav-icon-link {{ request()->routeIs('categorias.*') ? 'nav-icon-link-active' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 6.75h6.75v6.75H4.5V6.75Zm8.25 0h6.75v6.75h-6.75V6.75ZM4.5 15h6.75v2.25H4.5V15Zm8.25 0h6.75v2.25h-6.75V15Z" />
    </svg>

    <span class="nav-icon-label">Categorías</span>
    <span class="nav-tooltip">Categorías</span>
</a>

<a href="{{ route('admin.ventas.index') }}" title="Ventas" aria-label="Ventas" class="nav-icon-link {{ request()->routeIs('admin.ventas.*') ? 'nav-icon-link-active' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3.75h10.5v16.5l-2.25-1.5-2.25 1.5-2.25-1.5-2.25 1.5-2.25-1.5-2.25 1.5V3.75Zm3 5.25h4.5m-4.5 3h4.5m-4.5 3h3" />
    </svg>

    <span class="nav-icon-label">Ventas</span>
    <span class="nav-tooltip">Ventas</span>
</a>

@endsection