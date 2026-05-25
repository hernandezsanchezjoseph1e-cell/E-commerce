@extends('layouts.auth')

@section('title', 'Iniciar sesión')

@section('content')

<div class="space-y-6">

    <div class="text-center">
        <h2 class="text-2xl font-bold text-slate-900">
            Iniciar sesión
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Accede a tu cuenta para continuar.
        </p>
    </div>

    @if(session('status'))
    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700">
                Correo electrónico
            </label>

            <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required autofocus class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

            @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700">
                Contraseña
            </label>

            <input id="password" type="password" name="password" autocomplete="current-password" required class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

            @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between gap-4">
            <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="remember" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">

                <span>
                    Recordarme
                </span>
            </label>

            @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800 hover:underline">
                ¿Olvidaste tu contraseña?
            </a>
            @endif
        </div>

        <button type="submit" class="w-full rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-emerald-500/20">
            Iniciar sesión
        </button>
    </form>

</div>

@endsection