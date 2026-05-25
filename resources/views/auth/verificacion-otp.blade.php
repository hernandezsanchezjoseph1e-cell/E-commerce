@extends('layouts.auth')

@section('title', 'Verificación en dos pasos | Tech & Home')

@section('content')

<div class="space-y-6">

    <div class="text-center">
        <h2 class="text-2xl font-bold text-slate-900">
            Verificación en dos pasos
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Ingresa el código que enviamos a tu correo electrónico.
        </p>
    </div>

    @if(session('status'))
    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
        {{ session('status') }}
    </div>
    @endif

    <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
        <p class="text-sm text-slate-600">
            El código contiene <strong class="font-semibold text-slate-900">6 dígitos</strong> y expira en <strong class="font-semibold text-slate-900">5 minutos</strong>.
        </p>
    </div>

    <form method="POST" action="{{ route('2fa.verificar') }}" class="space-y-5">
        @csrf

        <div>
            <label for="codigo" class="block text-sm font-semibold text-slate-700">
                Código de verificación
            </label>

            <input id="codigo" type="text" name="codigo" inputmode="numeric" maxlength="6" pattern="[0-9]{6}" autocomplete="one-time-code" autofocus required class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-center text-lg font-semibold tracking-[0.35em] text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

            @error('codigo')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-emerald-500/20">
            Verificar código
        </button>
    </form>

</div>

@endsection