@extends('layouts.app')

@section('title', 'Crear usuario')

@section('content')

<div class="mx-auto max-w-3xl space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-medium uppercase tracking-wide text-emerald-700">
                Administración
            </p>

            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                Crear usuario
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Registra un nuevo usuario y asigna su rol dentro del sistema.
            </p>
        </div>

        <a href="{{ route('usuarios.index') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Volver
        </a>
    </div>


    @if($errors->any())
    <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        <p class="font-semibold">
            Revisa los siguientes campos:
        </p>

        <ul class="mt-2 list-inside list-disc space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <form method="POST" action="{{ route('usuarios.store') }}" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <label for="nombre" class="block text-sm font-semibold text-slate-700">
                        Nombre
                    </label>

                    <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre del usuario" class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('nombre') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">

                    @error('nombre')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="apellidos" class="block text-sm font-semibold text-slate-700">
                        Apellidos
                    </label>

                    <input id="apellidos" type="text" name="apellidos" value="{{ old('apellidos') }}" placeholder="Apellidos del usuario" class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('apellidos') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">

                    @error('apellidos')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700">
                    Correo electrónico
                </label>

                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="usuario@correo.com" class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">

                @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="block text-sm font-semibold text-slate-700">
                    Rol
                </label>

                <select id="role" name="role" class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('role') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                    @foreach($roles as $rol)
                    <option value="{{ $rol }}" {{ old('role') === $rol ? 'selected' : '' }}>
                        {{ ucfirst($rol) }}
                    </option>
                    @endforeach
                </select>

                @error('role')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700">
                        Contraseña
                    </label>

                    <input id="password" type="password" name="password" placeholder="Contraseña" class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">

                    @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">
                        Confirmar contraseña
                    </label>

                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Repite la contraseña" class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                </div>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
                <a href="{{ route('usuarios.index') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Cancelar
                </a>

                <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-emerald-500/20">
                    Guardar usuario
                </button>
            </div>
        </form>

    </section>

</div>

@endsection