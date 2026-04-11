@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Editar Categoría</h1>

    <form action="{{ route('categorias.update',$categoria) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Nombre</label>
            <input type="text"
                name="nombre"
                value="{{ $categoria->nombre }}"
                class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label>Descripción</label>
            <textarea name="descripcion" class="border p-2 w-full">{{ $categoria->descripcion }}</textarea>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Actualizar
        </button>

    </form>

</div>

@endsection