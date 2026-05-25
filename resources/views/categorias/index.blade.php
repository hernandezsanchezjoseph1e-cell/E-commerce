@extends('layouts.app')

@section('title', 'Gestión de categorías | Tech & Home')

@section('content')

<div class="app-page">

    <div class="page-header">
        <div>
            <p class="page-kicker">
                {{ auth()->user()->role === 'administrador' ? 'Administración' : 'Gerencia' }}
            </p>

            <h1 class="page-title">
                Gestión de categorías
            </h1>

            <p class="page-description">
                Consulta las categorías disponibles para clasificar los productos del sistema.
            </p>
        </div>

        @if(auth()->user()->role === 'gerente')
        <a href="{{ route('categorias.create') }}" class="btn-primary w-full sm:w-auto">
            Nueva categoría
        </a>
        @endif
    </div>

    <section class="table-wrapper">

        <div class="card-header">
            <h2 class="card-title">
                Categorías registradas
            </h2>

            <p class="card-description">
                Listado general de categorías disponibles en Tech & Home.
            </p>
        </div>

        <div class="table-scroll">
            <table class="data-table">
                <thead class="data-thead">
                    <tr>
                        <th class="data-th">ID</th>
                        <th class="data-th">Nombre</th>
                        <th class="data-th">Descripción</th>
                        <th class="data-th-right">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($categorias as $categoria)
                    <tr class="data-row">
                        <td class="data-td">
                            #{{ $categoria->id }}
                        </td>

                        <td class="data-td-strong">
                            {{ $categoria->nombre }}
                        </td>

                        <td class="data-td">
                            {{ $categoria->descripcion ?? 'Sin descripción' }}
                        </td>

                        <td class="data-td">
                            <div class="flex items-center justify-end gap-3">

                                @if(auth()->user()->role === 'gerente')
                                <a href="{{ route('categorias.edit', $categoria) }}" class="action-link">
                                    Editar
                                </a>
                                @endif

                                @if(auth()->user()->role === 'administrador')
                                <button type="button"
                                    data-confirm-button
                                    data-confirm-title="Eliminar categoría"
                                    data-confirm-message="¿Seguro que deseas eliminar la categoría {{ $categoria->nombre }}?"
                                    data-confirm-action="{{ route('categorias.destroy', $categoria) }}"
                                    data-confirm-method="DELETE"
                                    data-confirm-text="Eliminar"
                                    data-confirm-variant="danger"
                                    class="danger-link">
                                    Eliminar
                                </button>
                                @endif

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="table-empty">
                            No hay categorías registradas.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </section>

</div>

@endsection