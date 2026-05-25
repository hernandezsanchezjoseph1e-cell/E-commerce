@extends('layouts.app')

@section('title', 'Mi perfil | Tech & Home')

@section('content')

<div class="page-container-md app-page">

    <div class="page-header-simple">
        <p class="page-kicker">
            Cuenta
        </p>

        <div>
            <h1 class="page-title">
                Mi perfil
            </h1>

            <p class="page-description">
                Administra tu información personal, contraseña y configuración de cuenta.
            </p>
        </div>
    </div>

    <section class="card">
        <div class="card-header">
            <h2 class="card-title">
                Información del perfil
            </h2>

            <p class="card-description">
                Actualiza tus datos personales y correo electrónico.
            </p>
        </div>

        <div class="card-body">
            @include('profile.partials.update-profile-information-form')
        </div>
    </section>

    <section class="card">
        <div class="card-header">
            <h2 class="card-title">
                Cambiar contraseña
            </h2>

            <p class="card-description">
                Usa una contraseña segura para proteger tu cuenta.
            </p>
        </div>

        <div class="card-body">
            @include('profile.partials.update-password-form')
        </div>
    </section>

    <section class="card border-red-200">
        <div class="card-header border-red-200 bg-red-50">
            <h2 class="text-lg font-semibold text-red-700">
                Eliminar cuenta
            </h2>

            <p class="mt-1 text-sm text-red-600">
                Esta acción eliminará permanentemente tu cuenta.
            </p>
        </div>

        <div class="card-body">
            @include('profile.partials.delete-user-form')
        </div>
    </section>

</div>

@endsection