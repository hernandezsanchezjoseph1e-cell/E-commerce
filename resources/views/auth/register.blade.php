@extends('layouts.auth')

@section('content')

<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold text-center mb-6">
        Crear cuenta
    </h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">
                Nombre
            </label>

            <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" required autofocus autocomplete="nombre" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

            @error('nombre')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div>
            <label for="apellidos" class="block text-sm font-medium text-gray-700">
                Apellidos
            </label>

            <input id="apellidos" type="text" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="apellidos" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

            @error('apellidos')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                Correo electrónico
            </label>

            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

            @error('email')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
            @enderror
        </div>

        <input type="hidden" name="role" value="cliente">

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
                Contraseña
            </label>

            <input id="password" type="password" name="password" required autocomplete="new-password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

            @error('password')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                Confirmar contraseña
            </label>

            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

            @error('password_confirmation')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="flex items-center justify-end gap-4 pt-2">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 underline hover:text-gray-900">
                ¿Ya estás registrado?
            </a>

            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Registrarme
            </button>
        </div>
    </form>
</div>

@endsection