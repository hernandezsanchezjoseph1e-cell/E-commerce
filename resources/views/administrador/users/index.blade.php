@extends('layouts.app')

@section('title', 'Gestión de usuarios | Tech & Home')

@section('content')

<div class="app-page">

    <div class="page-header">
        <div>
            <p class="page-kicker">
                Administración
            </p>

            <h1 class="page-title">
                Gestión de usuarios
            </h1>

            <p class="page-description">
                Administra usuarios, roles y accesos dentro del sistema.
            </p>
        </div>

        <a href="{{ route('usuarios.create') }}" class="btn-primary w-full sm:w-auto">
            Crear usuario
        </a>
    </div>

    <section class="card card-body">
        <form method="GET" action="{{ route('usuarios.index') }}" class="filter-grid">

            <div class="md:col-span-1 xl:col-span-6">
                <label for="search" class="form-label">
                    Buscar usuario
                </label>

                <input id="search" type="text" name="search" value="{{ request('search') }}" placeholder="Nombre, apellidos o correo..." class="form-control">
            </div>

            <div class="md:col-span-1 xl:col-span-4">
                <label for="role" class="form-label">
                    Rol
                </label>

                <select id="role" name="role" class="form-select">
                    <option value="">Todos</option>
                    <option value="cliente" {{ request('role') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                    <option value="gerente" {{ request('role') == 'gerente' ? 'selected' : '' }}>Gerente</option>
                    <option value="administrador" {{ request('role') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>

            <div class="flex items-end md:col-span-2 xl:col-span-2">
                <button type="submit" class="btn-primary w-full">
                    Filtrar
                </button>
            </div>

        </form>
    </section>

    <section class="table-wrapper">

        <div class="card-header">
            <h2 class="card-title">
                Usuarios registrados
            </h2>

            <p class="card-description">
                Listado general de usuarios registrados en Tech & Home.
            </p>
        </div>

        <div class="table-scroll">
            <table class="data-table">
                <thead class="data-thead">
                    <tr>
                        <th class="data-th">Nombre</th>
                        <th class="data-th">Apellidos</th>
                        <th class="data-th">Email</th>
                        <th class="data-th">Rol</th>
                        <th class="data-th-right">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($users as $user)
                    <tr class="data-row">
                        <td class="data-td-strong">
                            {{ $user->nombre }}
                        </td>

                        <td class="data-td">
                            {{ $user->apellidos }}
                        </td>

                        <td class="data-td">
                            {{ $user->email }}
                        </td>

                        <td class="data-td">
                            @if($user->role === 'administrador')
                            <span class="badge-slate">
                                Administrador
                            </span>
                            @elseif($user->role === 'gerente')
                            <span class="badge-success">
                                Gerente
                            </span>
                            @else
                            <span class="badge-info">
                                Cliente
                            </span>
                            @endif
                        </td>

                        <td class="data-td">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('usuarios.edit', $user) }}" class="action-link">
                                    Editar
                                </a>

                                <button type="button"
                                    data-confirm-button
                                    data-confirm-title="Eliminar usuario"
                                    data-confirm-message="¿Seguro que deseas eliminar a {{ $user->nombre }} {{ $user->apellidos }}?"
                                    data-confirm-action="{{ route('usuarios.destroy', $user) }}"
                                    data-confirm-method="DELETE"
                                    data-confirm-text="Eliminar"
                                    data-confirm-variant="danger"
                                    class="danger-link">
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="table-empty">
                            No se encontraron usuarios registrados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $users->links() }}
        </div>

    </section>

</div>

@endsection