@extends('layouts.app')

@section('title','Dashboard Administrador')

@section('content')

<h2 class="text-xl font-semibold text-gray-800 mb-6">
    Panel Administrador - {{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}
</h2>

<div class="p-6 space-y-6">

    @include('administrador.partials.resumen')

    @include('administrador.partials.productos-categoria')

    @include('administrador.partials.top-producto')

    @include('administrador.partials.top-comprador')

</div>

@endsection