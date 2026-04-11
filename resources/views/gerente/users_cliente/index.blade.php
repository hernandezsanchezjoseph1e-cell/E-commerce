@extends('layouts.app')

@section('content')
<div class="p-6">

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
                    <a href="{{ route('clientes.edit', $user) }}"
                        class="text-blue-600">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection