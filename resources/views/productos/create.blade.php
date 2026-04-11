@extends('layouts.app')

@section('content')

@if(auth()->user()->role !== 'gerente')
<div class="container mx-auto p-6">
    <p class="text-red-600">No tienes permiso para crear productos.</p>
</div>
@else

<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Crear Producto</h1>

    <form action="{{ route('productos.store') }}" method="POST">

        @csrf

        <div class="mb-4">
            <label class="block">Nombre</label>
            <input type="text" name="nombre" class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label class="block">Descripción</label>
            <textarea name="descripcion" class="border p-2 w-full"></textarea>
        </div>

        <div class="mb-4">
            <label class="block">Precio</label>
            <input type="number" step="0.01" name="precio" class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label class="block">Existencia</label>
            <input type="number" name="existencia" class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label class="block">Categorías</label>

            <select name="categorias[]" multiple class="border p-2 w-full">

                @foreach($categorias as $categoria)

                <option value="{{ $categoria->id }}">
                    {{ $categoria->nombre }}
                </option>

                @endforeach

            </select>

        </div>

        <button class="bg-green-500 text-white px-4 py-2 rounded">
            Guardar
        </button>

    </form>

</div>

@endif

@endsection