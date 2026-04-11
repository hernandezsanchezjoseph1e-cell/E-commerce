@extends('layouts.auth')

@section('content')

<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-semibold text-center mb-6">
        Iniciar sesión
    </h2>

    @if(session('status'))
        <div class="mb-4 text-green-600 text-sm">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="mt-1 w-full border-gray-300 rounded-md shadow-sm"
                required
            >

            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">
                Contraseña
            </label>

            <input
                type="password"
                name="password"
                class="mt-1 w-full border-gray-300 rounded-md shadow-sm"
                required
            >

            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember -->
        <div class="flex items-center mb-4">
            <input type="checkbox" name="remember" class="mr-2">
            <span class="text-sm text-gray-600">Recordarme</span>
        </div>

        <button
            type="submit"
            class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700"
        >
            Iniciar sesión
        </button>

        @if(Route::has('password.request'))
            <div class="mt-4 text-center">
                <a
                    href="{{ route('password.request') }}"
                    class="text-sm text-indigo-600 hover:underline"
                >
                    ¿Olvidaste tu contraseña?
                </a>
            </div>
        @endif

    </form>

</div>

@endsection