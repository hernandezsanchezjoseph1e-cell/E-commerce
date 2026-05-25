<footer class="bg-slate-950 text-slate-400">
    <div class="max-w-7xl mx-auto grid grid-cols-1 gap-12 px-6 py-16 md:grid-cols-3">

        {{-- Marca --}}
        <div>
            <p class="text-xl font-bold tracking-tight text-white">
                Tech & Home
            </p>

            <p class="mt-3 text-sm leading-6">
                Tecnología, accesorios y soluciones prácticas para mejorar la experiencia dentro del hogar.
            </p>
        </div>

        {{-- Enlaces --}}
        <div>
            <p class="font-semibold text-white">
                Explora
            </p>

            <ul class="mt-4 space-y-2 text-sm">
                <li>
                    <a href="{{ route('inicio') }}#productos" class="transition hover:text-white">
                        Productos
                    </a>
                </li>

                <li>
                    <a href="{{ route('inicio') }}#nosotros" class="transition hover:text-white">
                        Nosotros
                    </a>
                </li>

                <li>
                    <a href="{{ route('inicio') }}#contacto" class="transition hover:text-white">
                        Contacto
                    </a>
                </li>

                @guest
                <li>
                    <a href="{{ route('login') }}" class="transition hover:text-white">
                        Iniciar sesión
                    </a>
                </li>
                @endguest
            </ul>
        </div>

        {{-- Contacto --}}
        <div>
            <p class="font-semibold text-white">
                Atención
            </p>

            <ul class="mt-4 space-y-2 text-sm leading-6">
                <li>Correo: contacto@techandhome.com</li>
                <li>Teléfono: +52 961 000 0000</li>
                <li>Horario: lunes a sábado, 9:00 a 20:00</li>
                <li>Ubicación: Tuxtla Gutiérrez, Chiapas</li>
            </ul>
        </div>

    </div>

    <div class="border-t border-white/10 px-6 py-6 text-center text-xs text-slate-500">
        © {{ date('Y') }} Tech & Home. Todos los derechos reservados.
    </div>
</footer>