@extends('layouts.app')

@section('title','Mi cuenta')

@section('content')

@php
$ventasPendientes = \App\Models\Venta::where('vendedor_id', auth()->id())
->where('validada', false)
->whereNotNull('referencia_pago')
->distinct()
->count('referencia_pago');
@endphp

<h2 class="text-xl font-semibold text-gray-800 mb-6">
    Bienvenido gerente, {{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}
</h2>

<a href="{{ route('ventas.create') }}" class="inline-flex items-center bg-white shadow rounded px-4 py-3 text-gray-700 hover:bg-gray-50">
    <span>Ventas pendientes</span>

    @if($ventasPendientes > 0)
    <span class="ml-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full">
        {{ $ventasPendientes }}
    </span>
    @endif
</a>


@endsection