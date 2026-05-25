@extends('layouts.app')

@section('title', 'Crear categoría | Tech & Home')

@section('content')

<div class="page-container-sm app-page">

    <div class="page-header">
        <div>
            <p class="page-kicker">
                Gerencia
            </p>

            <h1 class="page-title">
                Crear categoría
            </h1>

            <p class="page-description">
                Registra una nueva categoría para clasificar productos.
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

    <section class="card card-body">
        <form action="{{ route('categorias.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="nombre" class="form-label">
                    Nombre
                </label>

                <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre de la categoría" class="form-control">

                @error('nombre')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="descripcion" class="form-label">
                    Descripción
                </label>

                <textarea id="descripcion" name="descripcion" rows="4" placeholder="Descripción breve de la categoría" class="form-textarea">{{ old('descripcion') }}</textarea>

                @error('descripcion')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
                <a href="{{ route('categorias.index') }}" class="btn-secondary">
                    Cancelar
                </a>

                <button type="submit" class="btn-primary">
                    Guardar categoría
                </button>
            </div>
        </form>
    </section>

</div>

@endsection