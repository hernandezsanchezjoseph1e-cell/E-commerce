<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Quessini')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-gray-100">

<div class="min-h-screen flex flex-col justify-center items-center">

    <div class="mb-6">
        <a href="/">
            <h1 class="text-3xl font-bold text-gray-800">
                Quessini
            </h1>
        </a>
    </div>

    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-6">
        @yield('content')
    </div>

</div>

</body>

</html>