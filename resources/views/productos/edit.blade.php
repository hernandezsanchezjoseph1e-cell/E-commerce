@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Editar Producto</h1>

    <form action="{{ route('productos.update',$producto) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Nombre</label>
            <input type="text" name="nombre"
                value="{{ old('nombre', $producto->nombre) }}"
                class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label>Descripción</label>
            <textarea name="descripcion" class="border p-2 w-full">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div class="mb-4">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio"
                value="{{ old('precio', $producto->precio) }}"
                class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label>Existencia</label>
            <input type="number" name="existencia"
                value="{{ old('existencia', $producto->existencia) }}"
                class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label>Categorías</label>

            <select name="categorias[]" multiple class="border p-2 w-full">
                @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}"
                    {{ in_array($categoria->id, old('categorias', $producto->categorias->pluck('id')->toArray())) ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Reemplazar fotos del producto</label>
            <input type="file" name="fotos[]" multiple class="border p-2 w-full">
        </div>

        @if($producto->fotos)
        <div class="mb-4">
            <label class="block mb-2">Fotos actuales:</label>
            <div class="flex gap-2 flex-wrap">
                @foreach($producto->fotos as $foto)
                <img src="{{ asset('storage/' . $foto) }}" width="100" class="border">
                @endforeach
            </div>
        </div>
        @endif

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Actualizar
        </button>

    </form>


</div>

@endsection