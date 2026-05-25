@extends('layouts.auth')

@section('title', 'Verificar correo | Tech & Home')

@section('content')

<div class="space-y-6">

    <div class="text-center">
        <h2 class="text-2xl font-bold text-slate-900">
            Verificar correo
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Antes de continuar, verifica tu dirección de correo electrónico.
        </p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-4">
        <p class="text-sm leading-6 text-slate-600">
            Te enviamos un enlace de verificación. Revisa tu bandeja de entrada y confirma tu correo para poder acceder al sistema.
        </p>
    </div>

    @if(session('resent') || session('status') === 'verification-link-sent')
    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
        Se ha enviado un nuevo enlace de verificación a tu dirección de correo.
    </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button type="submit" class="w-full rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-emerald-500/20">
            Reenviar correo de verificación
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Cerrar sesión
        </button>
    </form>

</div>

@endsection