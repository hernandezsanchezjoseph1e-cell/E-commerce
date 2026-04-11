@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Categorías</h1>

        @if(auth()->user()->role === 'gerente')
        <a href="{{ route('categorias.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded">
            Nuevo Categoria
        </a>
        @endif
    </div>

    <table class="w-full border border-gray-300">

        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Nombre</th>
                <th class="p-2">Descripción</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>

        <tbody>

            @foreach($categorias as $categoria)

            <tr class="border-t">

                <td class="p-2">
                    {{ $categoria->id }}
                </td>

                <td class="p-2">
                    {{ $categoria->nombre }}
                </td>

                <td class="p-2">
                    {{ $categoria->descripcion }}
                </td>

                <td class="p-2 flex gap-3">

                    {{-- EDITAR SOLO GERENTE --}}
                    @if(auth()->user()->role === 'gerente')
                    <a href="{{ route('categorias.edit',$categoria) }}"
                        class="text-blue-600">
                        Editar
                    </a>
                    @endif

                    {{-- ELIMINAR SOLO ADMIN --}}
                    @if(auth()->user()->role === 'administrador')

                    <form action="{{ route('categorias.destroy',$categoria) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button class="text-red-600">
                            Eliminar
                        </button>

                    </form>

                    @endif

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection