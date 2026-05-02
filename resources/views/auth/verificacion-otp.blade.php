@extends('layouts.auth')

@section('content')

<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-semibold text-center mb-6">
        Verificación en dos pasos
    </h2>

    @if(session('status'))
    <div class="mb-4 text-green-600 text-sm">
        {{ session('status') }}
    </div>
    @endif

    <p class="text-sm text-gray-600 mb-4">
        Ingresa el código de 6 dígitos que enviamos a tu correo electrónico.
        Expira en <strong>5 minutos</strong>.
    </p>

    <form method="POST" action="{{ route('2fa.verificar') }}">
        @csrf

        <!-- Código OTP -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">
                Código de verificación
            </label>

            <input
                type="text"
                name="codigo"
                inputmode="numeric"
                maxlength="6"
                pattern="[0-9]{6}"
                autocomplete="one-time-code"
                autofocus
                class="mt-1 w-full border-gray-300 rounded-md shadow-sm tracking-widest text-center text-lg"
                required>

            @error('codigo')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
            Verificar código
        </button>


    </form>

</div>

@endsection