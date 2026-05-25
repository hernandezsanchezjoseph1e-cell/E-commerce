@extends('layouts.app')

@section('title', 'Editar usuario')

@section('content')

<div class="mx-auto max-w-3xl space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-medium uppercase tracking-wide text-emerald-700">
                Administración
            </p>

            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                Editar usuario
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Actualiza la información del usuario seleccionado.
            </p>
        </div>

        <a href="{{ route('usuarios.index') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Volver
        </a>
    </div>

    <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-4">
            <h2 class="text-lg font-semibold text-slate-900">
                Información del usuario
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                {{ $user->nombre }} {{ $user->apellidos }} · {{ $user->email }}
            </p>
        </div>

        <div class="p-6">
            @include('administrador.users.partials.form-profile', [
            'user' => $user,
            'roles' => $roles
            ])
        </div>

    </section>

</div>

@endsection