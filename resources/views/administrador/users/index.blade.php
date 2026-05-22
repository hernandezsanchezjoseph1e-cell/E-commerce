@extends('layouts.app')

@section('content')
<div class="p-6">

    <a href="{{ route('usuarios.create') }}"
        class="bg-gray-900 text-white px-4 py-2 rounded">
        Crear usuario
    </a>

    <form method="GET" action="{{ route('usuarios.index') }}" class="mb-4 flex gap-2">

        <input type="text" name="search"
            value="{{ request('search') }}"
            placeholder="Buscar usuario..."
            class="border px-2 py-1 rounded">

        <select name="role" class="border px-2 py-1 rounded">
            <option value="">Todos</option>
            <option value="cliente" {{ request('role') == 'cliente' ? 'selected' : '' }}>Cliente</option>
            <option value="gerente" {{ request('role') == 'gerente' ? 'selected' : '' }}>Gerente</option>
            <option value="administrador" {{ request('role') == 'administrador' ? 'selected' : '' }}>Admin</option>
        </select>

        <button class="bg-blue-600 text-white px-3 py-1 rounded">
            Filtrar
        </button>

    </form>

    <table class="w-full mt-6 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr class="border-t">
                <td class="p-2">{{ $user->nombre }}</td>
                <td>{{ $user->apellidos }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>

                <td class="flex gap-2 p-2">
                    <a href="{{ route('usuarios.edit', $user) }}"
                        class="text-blue-600">Editar</a>

                    <form method="POST"
                        action="{{ route('usuarios.destroy', $user) }}">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-600">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
    <div class="mt-4">
        {{ $users->links() }}
    </div>

</div>
@endsection