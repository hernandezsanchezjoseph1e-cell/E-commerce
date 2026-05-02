@extends('layouts.app')

@section('content')

@if(auth()->user()->role !== 'gerente')
<div class="container mx-auto p-6">
    <p class="text-red-600">No tienes permiso para crear productos.</p>
</div>
@else

<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Crear Producto</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
    <div class="bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-4">
            <label class="block">Nombre</label>
            <input type="text" name="nombre" class="border p-2 w-full" value="{{ old('nombre') }}">
        </div>

        <div class="mb-4">
            <label class="block">Descripción</label>
            <textarea name="descripcion" class="border p-2 w-full">{{ old('descripcion') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block">Precio</label>
            <input type="number" step="0.01" name="precio" class="border p-2 w-full" value="{{ old('precio') }}">
        </div>

        <div class="mb-4">
            <label class="block">Existencia</label>
            <input type="number" name="existencia" class="border p-2 w-full" value="{{ old('existencia') }}">
        </div>

        <div class="mb-4">
            <label class="block">Categorías</label>

            <select name="categorias[]" multiple class="border p-2 w-full">
                @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}"
                    {{ collect(old('categorias'))->contains($categoria->id) ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Fotos del producto</label>
            <input type="file" name="fotos[]" multiple class="border p-2 w-full">
        </div>

        <button class="bg-green-500 text-white px-4 py-2 rounded">
            Guardar
        </button>

    </form>


</div>

@endif

@endsection