@extends('layouts.auth')

@section('content')

<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-semibold text-center mb-6">
        Verificar Email
    </h2>

    <p class="text-center text-gray-600 mb-6">
        Antes de continuar, por favor verifica tu dirección de email haciendo clic en el enlace que te hemos enviado.
    </p>

    @if (session('resent'))
        <div class="mb-4 text-green-600 text-sm text-center">
            Se ha enviado un nuevo enlace de verificación a tu dirección de email.
        </div>
    @endif

    <div class="text-center">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Reenviar Email de Verificación
            </button>
        </form>
    </div>

    <div class="mt-6 text-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="text-sm text-gray-600 hover:text-gray-900"
            >
                Cerrar Sesión
            </button>
        </form>
    </div>

</div>

@endsection