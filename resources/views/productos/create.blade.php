@extends('layouts.app')

@section('title', 'Crear producto | Tech & Home')

@section('content')

@if(auth()->user()->role !== 'gerente')

<div class="app-page">
    <div class="alert-danger">
        No tienes permiso para crear productos.
    </div>
</div>

@else

<div class="page-container-md app-page">

    <div class="page-header">
        <div>
            <p class="page-kicker">
                Gerencia
            </p>

            <h1 class="page-title">
                Crear producto
            </h1>

            <p class="page-description">
                Registra un nuevo producto, asigna categorías y carga sus fotografías.
            </p>
        </div>

        <a href="{{ route('productos.index') }}" class="btn-secondary w-full sm:w-auto">
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
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="nombre" class="form-label">
                    Nombre
                </label>

                <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre del producto" class="form-control">

                @error('nombre')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="descripcion" class="form-label">
                    Descripción
                </label>

                <textarea id="descripcion" name="descripcion" rows="4" placeholder="Descripción breve del producto" class="form-textarea">{{ old('descripcion') }}</textarea>

                @error('descripcion')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-grid">
                <div>
                    <label for="precio" class="form-label">
                        Precio
                    </label>

                    <input id="precio" type="number" step="0.01" name="precio" value="{{ old('precio') }}" placeholder="0.00" class="form-control">

                    @error('precio')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="existencia" class="form-label">
                        Existencia
                    </label>

                    <input id="existencia" type="number" name="existencia" value="{{ old('existencia') }}" placeholder="Cantidad disponible" class="form-control">

                    @error('existencia')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="categorias" class="form-label">
                    Categorías
                </label>

                <select id="categorias" name="categorias[]" multiple class="form-select min-h-32">
                    @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ collect(old('categorias'))->contains($categoria->id) ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                    @endforeach
                </select>

                <p class="mt-2 text-xs text-slate-500">
                    Mantén presionada la tecla Ctrl o Cmd para seleccionar varias categorías.
                </p>

                @error('categorias')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="fotos" class="form-label">
                    Fotos del producto
                </label>

                <input id="fotos" type="file" name="fotos[]" multiple accept="image/jpeg,image/png,image/jpg,image/webp" class="form-file">

                @error('fotos')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
                <a href="{{ route('productos.index') }}" class="btn-secondary">
                    Cancelar
                </a>

                <button type="submit" class="btn-primary">
                    Guardar producto
                </button>
            </div>

        </form>
    </section>

</div>

@endif

@endsection