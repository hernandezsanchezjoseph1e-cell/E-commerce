@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Editar Producto</h1>

    <form action="{{ route('productos.update',$producto) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Nombre</label>
            <input type="text" name="nombre"
                value="{{ $producto->nombre }}"
                class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label>Descripción</label>
            <textarea name="descripcion" class="border p-2 w-full">
            {{ $producto->descripcion }}
            </textarea>
        </div>

        <div class="mb-4">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio"
                value="{{ $producto->precio }}"
                class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label>Existencia</label>
            <input type="number" name="existencia"
                value="{{ $producto->existencia }}"
                class="border p-2 w-full">
        </div>

        <div class="mb-4">

            <label>Categorías</label>

            <select name="categorias[]" multiple class="border p-2 w-full">

                @foreach($categorias as $categoria)

                <option value="{{ $categoria->id }}"
                    {{ $producto->categorias->contains($categoria->id) ? 'selected' : '' }}>

                    {{ $categoria->nombre }}

                </option>

                @endforeach

            </select>

        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Actualizar
        </button>

    </form>

</div>

@endsection