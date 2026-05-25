@extends('layouts.app')

@section('title', 'Dashboard Administrador | Tech & Home')

@section('content')

<div class="app-page">

    <div class="page-header-simple">
        <p class="page-kicker">
            Panel administrativo
        </p>

        <div>
            <h1 class="page-title">
                Bienvenido, {{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}
            </h1>

            <p class="page-description">
                Consulta el resumen general de usuarios, productos, categorías y ventas del sistema.
            </p>
        </div>
    </div>

    @include('administrador.partials.resumen')

    @include('administrador.partials.productos-categoria')

    @include('administrador.partials.top-producto')

    @include('administrador.partials.top-comprador')

</div>

@endsection