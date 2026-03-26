<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Gestión de Usuarios</h2>
    </x-slot>

    <div class="p-6">

        <a href="{{ route('users.create') }}"
           class="bg-gray-900 text-white px-4 py-2 rounded">
            Crear usuario
        </a>

        <table class="w-full mt-6 border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr class="border-t">
                        <td class="p-2">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>

                        <td class="flex gap-2 p-2">
                            <a href="{{ route('users.edit', $user) }}"
                               class="text-blue-600">Editar</a>

                            <form method="POST"
                                  action="{{ route('users.destroy', $user) }}">
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

    </div>
</x-app-layout>