@extends('layouts.navbars.navbar')

@section('menu')

@php
$cantidadCarrito = collect(session('carrito', []))->sum('cantidad');
@endphp

<a href="{{ route('carrito.index') }}" class="text-gray-600 hover:text-gray-900">
    Carrito
    @if($cantidadCarrito > 0)
    <span class="ml-1 bg-green-600 text-white text-xs px-2 py-1 rounded-full">
        {{ $cantidadCarrito }}
    </span>
    @endif
</a>

<a href="{{ route('cliente.ventas.index') }}" class="text-gray-600 hover:text-gray-900">
    Mis compras
</a>

@endsection