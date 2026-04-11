@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Productos</h1>

        @if(auth()->user()->role === 'gerente')
        <a href="{{ route('productos.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded">
            Nuevo Producto
        </a>
        @endif

    </div>

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Nombre</th>
                <th class="p-2">Precio</th>
                <th class="p-2">Existencia</th>
                <th class="p-2">Registrado por</th>
                <th class="p-2">Categorías</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($productos as $producto)

            <tr class="border-t">

                <td class="p-2">{{ $producto->id }}</td>

                <td class="p-2">{{ $producto->nombre }}</td>

                <td class="p-2">${{ $producto->precio }}</td>

                <td class="p-2">{{ $producto->existencia }}</td>

                <td class="p-2">
                    {{ $producto->usuario->nombre ?? 'N/A' }}
                </td>

                <td class="p-2">
                    @foreach($producto->categorias as $categoria)
                    <span class="bg-gray-300 px-2 py-1 rounded text-sm">
                        {{ $categoria->nombre }}
                    </span>
                    @endforeach
                </td>

                <td class="p-2 flex gap-3">

                    {{-- EDITAR SOLO GERENTE --}}
                    @if(auth()->user()->role === 'gerente')
                    <a href="{{ route('productos.edit',$producto) }}"
                        class="text-blue-600">
                        Editar
                    </a>
                    @endif

                    {{-- ELIMINAR SOLO ADMIN --}}
                    @if(auth()->user()->role === 'administrador')
                    <form action="{{ route('productos.destroy',$producto) }}"
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