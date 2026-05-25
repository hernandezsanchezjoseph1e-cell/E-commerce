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

    <main class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">

            <div class="mb-6 text-center">
                <a href="/" class="inline-block">
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                        Tech & Home
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Tecnología para tu hogar
                    </p>
                </a>
            </div>

            <section class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 sm:p-8">
                @yield('content')
            </section>

        </div>

    </main>

</body>

</html>