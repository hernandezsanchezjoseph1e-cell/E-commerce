@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Crear Categoría</h1>

    <form action="{{ route('categorias.store') }}" method="POST">

        @csrf

        <div class="mb-4">
            <label>Nombre</label>
            <input type="text" name="nombre" class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label>Descripción</label>
            <textarea name="descripcion" class="border p-2 w-full"></textarea>
        </div>

        <button class="bg-green-500 text-white px-4 py-2 rounded">
            Guardar
        </button>

    </form>

</div>

@endsection