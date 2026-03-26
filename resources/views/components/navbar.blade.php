<header class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        {{-- Logo / Marca --}}
        <a href="{{ url('/') }}" class="text-2xl font-bold tracking-tight text-gray-900">
            Quessini
        </a>

        {{-- Navegación central --}}
        <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600">
            <a href="#nosotros"  class="hover:text-gray-900 transition">Nosotros</a>
            <a href="#catalogo"  class="hover:text-gray-900 transition">Catálogo</a>
            <a href="#contacto"  class="hover:text-gray-900 transition">Contacto</a>
        </nav>

        {{-- Acciones --}}
        <div class="flex items-center gap-3">
            @auth
                {{-- Si ya está logueado, botón a su dashboard --}}
                @php
                    $dashboard = match(auth()->user()->role) {
                        'gerente'  => 'dashboard.gerente',
                        'empleado' => 'dashboard.empleado',
                        default    => 'dashboard.cliente',
                    };
                @endphp
                <a href="{{ route($dashboard) }}"
                   class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                    Mi cuenta
                </a>
            @else
                {{-- Si no está logueado --}}
                <a href="{{ route('login') }}"
                   class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                   class="text-sm font-medium bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    Registrarse
                </a>
            @endauth
        </div>

    </div>
</header>