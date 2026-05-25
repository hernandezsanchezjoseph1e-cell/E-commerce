@extends('layouts.app')

@section('title', 'Gestión de productos | Tech & Home')

@section('content')

<div class="app-page">

    <div class="page-header">
        <div>
            <p class="page-kicker">
                {{ auth()->user()->role === 'administrador' ? 'Administración' : 'Gerencia' }}
            </p>

            <h1 class="page-title">
                Gestión de productos
            </h1>

            <p class="page-description">
                Consulta los productos registrados, su existencia, vendedor y categorías asignadas.
            </p>
        </div>

        @if(auth()->user()->role === 'gerente')
        <a href="{{ route('productos.create') }}" class="btn-primary w-full sm:w-auto">
            Nuevo producto
        </a>
        @endif
    </div>

    <section class="card card-body">
        <form method="GET" action="{{ route('productos.index') }}" class="filter-grid">

            <div class="md:col-span-2 xl:col-span-5">
                <label for="search" class="form-label">
                    Buscar producto
                </label>

                <input id="search" type="text" name="search" value="{{ request('search') }}" placeholder="Nombre del producto..." class="form-control">
            </div>

            <div class="md:col-span-1 xl:col-span-4">
                <label for="categoria" class="form-label">
                    Categoría
                </label>

                <select id="categoria" name="categoria" class="form-select">
                    <option value="">Todas las categorías</option>

                    @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}" {{ request('categoria') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-1 xl:col-span-2">
                <label for="stock" class="form-label">
                    Stock
                </label>

                <select id="stock" name="stock" class="form-select">
                    <option value="">Todos</option>
                    <option value="bajo" {{ request('stock') == 'bajo' ? 'selected' : '' }}>
                        Stock bajo
                    </option>
                </select>
            </div>

            <div class="flex items-end md:col-span-2 xl:col-span-1">
                <button type="submit" class="btn-primary w-full">
                    Filtrar
                </button>
            </div>

        </form>
    </section>

    <section class="table-wrapper">

        <div class="card-header">
            <h2 class="card-title">
                Productos registrados
            </h2>

            <p class="card-description">
                Listado general de productos disponibles dentro del sistema.
            </p>
        </div>

        <div class="table-scroll">
            <table class="data-table-lg">
                <thead class="data-thead">
                    <tr>
                        <th class="data-th">ID</th>
                        <th class="data-th">Producto</th>
                        <th class="data-th">Precio</th>
                        <th class="data-th">Existencia</th>
                        <th class="data-th">Registrado por</th>
                        <th class="data-th">Categorías</th>
                        <th class="data-th-right">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($productos as $producto)
                    <tr class="data-row">
                        <td class="data-td">
                            #{{ $producto->id }}
                        </td>

                        <td class="data-td-strong">
                            {{ $producto->nombre }}
                        </td>

                        <td class="data-td-strong">
                            ${{ number_format($producto->precio, 2) }}
                        </td>

                        <td class="data-td">
                            @if($producto->existencia <= 0)
                                <span class="badge-danger">
                                Sin stock
                                </span>
                                @elseif($producto->existencia <= 5)
                                    <span class="badge-warning">
                                    {{ $producto->existencia }} disponibles
                                    </span>
                                    @else
                                    <span class="badge-success">
                                        {{ $producto->existencia }} disponibles
                                    </span>
                                    @endif
                        </td>

                        <td class="data-td">
                            {{ $producto->usuario->nombre ?? 'N/A' }}
                        </td>

                        <td class="data-td">
                            <div class="flex flex-wrap gap-2">
                                @forelse($producto->categorias as $categoria)
                                <span class="badge-slate">
                                    {{ $categoria->nombre }}
                                </span>
                                @empty
                                <span class="text-sm text-slate-400">
                                    Sin categoría
                                </span>
                                @endforelse
                            </div>
                        </td>

                        <td class="data-td">
                            <div class="flex items-center justify-end gap-3">

                                @if(auth()->user()->role === 'gerente')
                                <a href="{{ route('productos.edit', $producto) }}" class="action-link">
                                    Editar
                                </a>
                                @endif

                                @if(auth()->user()->role === 'administrador')
                                <button type="button"
                                    data-confirm-button
                                    data-confirm-title="Eliminar producto"
                                    data-confirm-message="¿Seguro que deseas eliminar el producto {{ $producto->nombre }}?"
                                    data-confirm-action="{{ route('productos.destroy', $producto) }}"
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
                        <td colspan="7" class="table-empty">
                            No se encontraron productos registrados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $productos->links() }}
        </div>

    </section>

</div>

@endsection