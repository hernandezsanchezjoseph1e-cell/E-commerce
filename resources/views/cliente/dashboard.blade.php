@extends('layouts.app')

@section('title','Mi cuenta')

@section('content')
<div class="container mx-auto p-6">

    <h2 class="text-xl font-semibold text-gray-800 mb-6">
        Bienvenido, {{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}
    </h2>

    <div class="bg-white shadow-sm rounded-lg p-6">
        Aquí verás tus pedidos y favoritos.
    </div>

    <a href="{{ route('cliente.ventas.index') }}">
        Mis compras
    </a>

    @foreach($categorias as $categoria)
    @include('cliente.components.categoria', ['categoria' => $categoria])
    @endforeach

</div>

@endsection