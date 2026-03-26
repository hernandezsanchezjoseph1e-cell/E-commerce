@extends('layouts.public')


@section('content')
    {{-- HERO --}}
    <section class="bg-gray-50 py-28 px-6 text-center">
        <p class="text-sm font-semibold tracking-widest text-gray-400 uppercase mb-4">
            Nueva colección 2025
        </p>
        <h1 class="text-5xl font-bold text-gray-900 leading-tight mb-6">
            Viste lo que <br class="hidden md:block"> realmente eres.
        </h1>
        <p class="text-lg text-gray-500 max-w-xl mx-auto mb-10">
            Ropa y calzado para hombre y mujer. Diseños contemporáneos
            con materiales de primera calidad.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#catalogo"
               class="bg-gray-900 text-white px-8 py-3 rounded-lg font-medium hover:bg-gray-700 transition">
                Ver catálogo
            </a>
            <a href="{{ route('register') }}"
               class="border border-gray-300 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition">
                Crear cuenta gratis
            </a>
        </div>
    </section>

    {{--CATEGORÍAS DESTACADAS--}}
    <section id="catalogo" class="py-20 px-6 max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">
            Explora nuestras categorías
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">

            <div class="bg-gray-100 rounded-2xl p-10 text-center hover:bg-gray-200 transition cursor-pointer">
                <div class="text-4xl mb-4">👗</div>
                <p class="text-lg font-semibold text-gray-800">Ropa Mujer</p>
                <p class="text-sm text-gray-500 mt-1">+120 productos</p>
            </div>

            <div class="bg-gray-100 rounded-2xl p-10 text-center hover:bg-gray-200 transition cursor-pointer">
                <div class="text-4xl mb-4">👔</div>
                <p class="text-lg font-semibold text-gray-800">Ropa Hombre</p>
                <p class="text-sm text-gray-500 mt-1">+95 productos</p>
            </div>

            <div class="bg-gray-100 rounded-2xl p-10 text-center hover:bg-gray-200 transition cursor-pointer">
                <div class="text-4xl mb-4">👟</div>
                <p class="text-lg font-semibold text-gray-800">Calzado</p>
                <p class="text-sm text-gray-500 mt-1">+80 productos</p>
            </div>

        </div>
    </section>

    {{--QUIÉNES SOMOS --}}
    <section id="nosotros" class="bg-gray-50 py-20 px-6">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

            <div>
                <p class="text-sm font-semibold tracking-widest text-gray-400 uppercase mb-3">
                    Nuestra historia
                </p>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">
                    Quiénes somos
                </h2>
                <p class="text-gray-500 leading-relaxed mb-4">
                    Quessini nació en 2015 con una idea simple: que vestirse bien no debería
                    ser complicado ni costoso. Somos una tienda familiar con raíces mexicanas
                    y pasión por la moda contemporánea.
                </p>
                <p class="text-gray-500 leading-relaxed">
                    Trabajamos con proveedores locales para ofrecerte prendas y calzado
                    con materiales de alta calidad, diseños actuales y precios justos.
                    Más de 10,000 clientes satisfechos nos respaldan.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl p-6 text-center shadow-sm">
                    <p class="text-4xl font-bold text-gray-900">10+</p>
                    <p class="text-sm text-gray-500 mt-1">Años de experiencia</p>
                </div>
                <div class="bg-white rounded-2xl p-6 text-center shadow-sm">
                    <p class="text-4xl font-bold text-gray-900">300+</p>
                    <p class="text-sm text-gray-500 mt-1">Productos disponibles</p>
                </div>
                <div class="bg-white rounded-2xl p-6 text-center shadow-sm">
                    <p class="text-4xl font-bold text-gray-900">10k+</p>
                    <p class="text-sm text-gray-500 mt-1">Clientes felices</p>
                </div>
                <div class="bg-white rounded-2xl p-6 text-center shadow-sm">
                    <p class="text-4xl font-bold text-gray-900">5★</p>
                    <p class="text-sm text-gray-500 mt-1">Calificación promedio</p>
                </div>
            </div>

        </div>
    </section>

    {{--CONTACTO--}}
    <section id="contacto" class="py-20 px-6 max-w-3xl mx-auto text-center">
        <p class="text-sm font-semibold tracking-widest text-gray-400 uppercase mb-3">
            Estamos aquí
        </p>
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Contáctanos</h2>
        <p class="text-gray-500 mb-12">
            ¿Tienes dudas sobre un producto, tu pedido o cualquier otra cosa?
            Escríbenos y te respondemos en menos de 24 horas.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 text-left">
            <div class="bg-gray-50 rounded-2xl p-6">
                <p class="font-semibold text-gray-800 mb-1">Dirección</p>
                <p class="text-sm text-gray-500">Av. Moda 123, Col. Centro<br>Ciudad de México, CDMX</p>
            </div>
            <div class="bg-gray-50 rounded-2xl p-6">
                <p class="font-semibold text-gray-800 mb-1">Teléfono y Email</p>
                <p class="text-sm text-gray-500">+52 55 1234 5678<br>hola@quessini.com</p>
            </div>
            <div class="bg-gray-50 rounded-2xl p-6">
                <p class="font-semibold text-gray-800 mb-1">Horario</p>
                <p class="text-sm text-gray-500">Lunes a Sábado<br>9:00 am – 8:00 pm</p>
            </div>
        </div>
    </section>

@endsection