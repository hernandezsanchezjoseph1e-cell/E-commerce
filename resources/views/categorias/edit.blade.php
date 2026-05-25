@extends('layouts.app')

@section('title', 'Editar categoría | Tech & Home')

@section('content')

<div class="page-container-sm app-page">

    <div class="page-header">
        <div>
            <p class="page-kicker">
                Gerencia
            </p>

            <h1 class="page-title">
                Editar categoría
            </h1>

            <p class="page-description">
                Actualiza la información de la categoría seleccionada.
            </p>
        </div>

        <a href="{{ route('categorias.index') }}" class="btn-secondary w-full sm:w-auto">
            Volver
        </a>
    </div>

    @if($errors->any())
    <div class="alert-danger">
        <p class="font-semibold">
            Revisa los siguientes campos:
        </p>

        <ul class="mt-2 list-inside list-disc space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <section class="card">

        <div class="card-header">
            <h2 class="card-title">
                Información de la categoría
            </h2>

            <p class="card-description">
                {{ $categoria->nombre }}
            </p>
        </div>

        <div class="card-body">
            <form action="{{ route('categorias.update', $categoria) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="nombre" class="form-label">
                        Nombre
                    </label>

                    <input id="nombre" type="text" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" class="form-control">

                    @error('nombre')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="descripcion" class="form-label">
                        Descripción
                    </label>

                    <textarea id="descripcion" name="descripcion" rows="4" class="form-textarea">{{ old('descripcion', $categoria->descripcion) }}</textarea>

                    @error('descripcion')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
                    <a href="{{ route('categorias.index') }}" class="btn-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn-primary">
                        Actualizar categoría
                    </button>
                </div>
            </form>
        </div>

    </section>

</div>

@endsection