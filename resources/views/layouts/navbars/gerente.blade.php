@extends('layouts.navbars.navbar')

@section('menu')

<a href="{{ route('clientes.index') }}" class="text-gray-600 hover:text-gray-900">
    Clientes
</a>

<a href="{{ route('productos.index') }}" class="text-gray-600 hover:text-gray-900">
    Productos
</a>

<a href="{{ route('categorias.index') }}" class="text-gray-600 hover:text-gray-900">
    Categorías
</a>

<a href="{{ route('ventas.create') }}" class="text-gray-600 hover:text-gray-900">
    Venta
</a>

@endsection