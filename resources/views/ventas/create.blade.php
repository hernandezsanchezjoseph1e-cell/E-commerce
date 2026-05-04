@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Registrar Venta</h1>

    {{-- errores de validación --}}
    @if ($errors->any())
    <div class="bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('ventas.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        {{-- PRODUCTO --}}
        <div class="mb-4">
            <label class="block">Producto</label>

            <select name="producto_id" class="border p-2 w-full">
                @foreach($productos as $producto)
                <option value="{{ $producto->id }}"
                    {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                    {{ $producto->nombre }} - ${{ $producto->precio }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- CLIENTE SOLO SI ES GERENTE --}}
        @if(auth()->user()->role === 'gerente')
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
        @endif

        {{-- TICKET --}}
        <div class="mb-4">
            <label class="block">Ticket (imagen)</label>
            <input type="file" name="ticket" class="border p-2 w-full">
        </div>

        <button class="bg-green-500 text-white px-4 py-2 rounded">
            Registrar venta
        </button>

    </form>

</div>

@endsection