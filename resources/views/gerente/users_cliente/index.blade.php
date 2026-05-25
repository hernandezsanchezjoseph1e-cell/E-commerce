@extends('layouts.app')

@section('title', 'Gestión de clientes | Tech & Home')

@section('content')

<div class="app-page">

    <div class="page-header-simple">
        <p class="page-kicker">
            Gerencia
        </p>

        <div>
            <h1 class="page-title">
                Gestión de clientes
            </h1>

            <p class="page-description">
                Consulta y administra la información de los clientes registrados en el sistema.
            </p>
        </div>
    </div>

    <section class="card card-body">
        <form method="GET" action="{{ route('clientes.index') }}" class="filter-grid">

            <div class="md:col-span-2 xl:col-span-10">
                <label for="search" class="form-label">
                    Buscar cliente
                </label>

                <input id="search" type="text" name="search" value="{{ request('search') }}" placeholder="Nombre, apellidos o correo..." class="form-control">
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
                Clientes registrados
            </h2>

            <p class="card-description">
                Listado de clientes disponibles para gestión por parte del gerente.
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
                            <span class="badge-info">
                                Cliente
                            </span>
                        </td>

                        <td class="data-td">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('clientes.edit', $user) }}" class="action-link">
                                    Editar
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="table-empty">
                            No se encontraron clientes registrados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($users, 'links'))
        <div class="card-footer">
            {{ $users->links() }}
        </div>
        @endif

    </section>

</div>

@endsection