@extends('layouts.app')

@section('title','Mi cuenta')

@section('content')
<div class="container mx-auto p-6">

    <h2 class="text-xl font-semibold text-gray-800 mb-6">
        Bienvenido, {{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}
    </h2>

    {{-- MENSAJE DE ÉXITO --}}
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    {{-- ERRORES --}}
    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc ml-5">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg p-6">
        Aquí verás tus pedidos y favoritos.
    </div>


    @foreach($categorias as $categoria)
    @include('cliente.components.categoria', ['categoria' => $categoria])
    @endforeach

</div>

@endsection