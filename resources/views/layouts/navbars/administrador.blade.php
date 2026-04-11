@extends('layouts.navbars.navbar')

@section('menu')

<a href="{{ route('usuarios.index') }}" class="text-gray-600 hover:text-gray-900">
    Usuarios
</a>

<a href="{{ route('productos.index') }}" class="text-gray-600 hover:text-gray-900">
    Ver Productos
</a>

<a href="{{ route('categorias.index') }}" class="text-gray-600 hover:text-gray-900">
    Ver Categorías
</a>

<a href="{{ route('admin.ventas.index') }}" class="text-gray-600 hover:text-gray-900">
    Ver Ventas
</a>

@endsection