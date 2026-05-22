@extends('layouts.navbars.navbar')

@section('menu')

@php
$ventasPendientes = \App\Models\Venta::where('vendedor_id', auth()->id())
->where('validada', false)
->whereNotNull('referencia_pago')
->distinct()
->count('referencia_pago');
@endphp

<a href="{{ route('clientes.index') }}" class="text-gray-600 hover:text-gray-900">
    Clientes
</a>

<a href="{{ route('productos.index') }}" class="text-gray-600 hover:text-gray-900">
    Productos
</a>

<a href="{{ route('categorias.index') }}" class="text-gray-600 hover:text-gray-900">
    Categorías
</a>

<a href="{{ route('ventas.index') }}" class="text-gray-600 hover:text-gray-900">
    Venta
</a>


@endsection