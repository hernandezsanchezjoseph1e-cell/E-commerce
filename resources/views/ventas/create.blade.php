@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Registrar Venta</h1>

    <form action="{{ route('ventas.store') }}" method="POST">

        @csrf

        <div class="mb-4">
            <label class="block">Producto</label>

            <select name="producto_id" class="border p-2 w-full">

                @foreach($productos as $producto)

                <option value="{{ $producto->id }}">
                    {{ $producto->nombre }} - ${{ $producto->precio }}
                </option>

                @endforeach

            </select>

        </div>


        <div class="mb-4">
            <label class="block">Cliente</label>

            <select name="cliente_id" class="border p-2 w-full">

                @foreach($clientes as $cliente)

                <option value="{{ $cliente->id }}">
                    {{ $cliente->nombre }}
                </option>

                @endforeach

            </select>

        </div>


        <button class="bg-green-500 text-white px-4 py-2 rounded">
            Registrar venta
        </button>

    </form>

</div>

@endsection