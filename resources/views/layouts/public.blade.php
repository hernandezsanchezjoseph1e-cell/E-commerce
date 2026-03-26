<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'Quessini — Moda y calzado para cada momento.' }}">
    <title>{{ $title ?? 'Quessini' }}</title>

     <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 font-sans antialiased">

    {{-- Navbar --}}
    <x-navbar />

    {{-- Contenido de cada página --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-footer />

</body>
</html>