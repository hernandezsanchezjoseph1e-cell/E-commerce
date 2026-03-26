<footer class="bg-gray-900 text-gray-400 mt-24">
    <div class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-3 gap-12">

        {{-- Columna 1: Marca --}}
        <div>
            <p class="text-white text-xl font-bold mb-3">Quessini</p>
            <p class="text-sm leading-relaxed">
                Moda y calzado pensados para cada momento de tu vida.
                Calidad, estilo y comodidad en un solo lugar.
            </p>
        </div>

        {{-- Columna 2: Enlaces --}}
        <div>
            <p class="text-white font-semibold mb-4">Explora</p>
            <ul class="space-y-2 text-sm">
                <li><a href="#nosotros" class="hover:text-white transition">Quiénes somos</a></li>
                <li><a href="#catalogo" class="hover:text-white transition">Catálogo</a></li>
                <li><a href="#contacto" class="hover:text-white transition">Contacto</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-white transition">Iniciar sesión</a></li>
            </ul>
        </div>

        {{-- Columna 3: Contacto --}}
        <div>
            <p class="text-white font-semibold mb-4">Contáctanos</p>
            <ul class="space-y-2 text-sm">
                <li>📍 Av. Moda 123, Ciudad de México</li>
                <li>📞 +52 55 1234 5678</li>
                <li>✉️ hola@quessini.com</li>
                <li>🕐 Lun–Sáb, 9am – 8pm</li>
            </ul>
        </div>

    </div>

    <div class="border-t border-gray-800 text-center py-6 text-xs text-gray-600">
        © {{ date('Y') }} Quessini. Todos los derechos reservados.
    </div>
</footer>