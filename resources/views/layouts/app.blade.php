<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Tech & Home')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-100 text-slate-900">

    @auth
    @switch(auth()->user()->role)
    @case('administrador')
    @include('layouts.navbars.administrador')
    @break

    @case('gerente')
    @include('layouts.navbars.gerente')
    @break

    @case('cliente')
    @include('layouts.navbars.cliente')
    @break
    @endswitch
    @endauth

    <div class="min-h-screen">

        @hasSection('header')
        <header class="border-b border-slate-200 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                @yield('header')
            </div>
        </header>
        @endif

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            @yield('content')
        </main>

    </div>

    <x-confirm-modal />

</body>

</html>