<header x-data="{ open: false }" class="sticky top-0 z-50 border-b border-slate-200 bg-white/90 backdrop-blur">

    @auth
    @php
    $dashboardRoute = match(auth()->user()->role) {
    'administrador' => 'dashboard.administrador',
    'gerente' => 'dashboard.gerente',
    default => 'dashboard.cliente',
    };
    @endphp
    @endauth

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex h-16 items-center justify-between">

            {{-- Marca --}}
            <a href="{{ route('inicio') }}" class="flex flex-col leading-tight">
                <span class="text-xl font-bold tracking-tight text-slate-900">
                    Tech & Home
                </span>

                <span class="hidden text-xs text-slate-500 sm:block">
                    Tecnología para tu hogar
                </span>
            </a>

            {{-- Navegación desktop --}}
            <nav class="hidden items-center gap-8 text-sm font-semibold text-slate-600 md:flex">
                <a href="{{ route('inicio') }}#productos" class="transition hover:text-emerald-700">
                    Productos
                </a>

                <a href="{{ route('inicio') }}#nosotros" class="transition hover:text-emerald-700">
                    Nosotros
                </a>

                <a href="{{ route('inicio') }}#contacto" class="transition hover:text-emerald-700">
                    Contacto
                </a>
            </nav>

            {{-- Acciones desktop --}}
            <div class="hidden items-center gap-2 md:flex">

                @auth
                <a href="{{ route($dashboardRoute) }}" title="Mi cuenta" aria-label="Mi cuenta" class="nav-icon-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
                    </svg>

                    <span class="nav-icon-label">
                        Mi cuenta
                    </span>

                    <span class="nav-tooltip">
                        Mi cuenta
                    </span>
                </a>
                @else
                <a href="{{ route('login') }}" title="Iniciar sesión" aria-label="Iniciar sesión" class="nav-icon-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
                    </svg>

                    <span class="nav-icon-label">
                        Iniciar sesión
                    </span>

                    <span class="nav-tooltip">
                        Iniciar sesión
                    </span>
                </a>
                @endauth

            </div>

            {{-- Botón móvil --}}
            <button type="button" @click="open = !open" class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white p-2 text-slate-600 transition hover:bg-slate-50 md:hidden">
                <span class="sr-only">Abrir menú</span>

                <svg x-show="!open" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>

                <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>

        </div>

        {{-- Navegación móvil --}}
        <div x-show="open" x-cloak class="border-t border-slate-200 py-4 md:hidden">
            <div class="flex flex-col gap-2">

                <a href="{{ route('inicio') }}#productos" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                    Productos
                </a>

                <a href="{{ route('inicio') }}#nosotros" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                    Nosotros
                </a>

                <a href="{{ route('inicio') }}#contacto" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                    Contacto
                </a>

                <div class="mt-3 flex flex-col gap-2 border-t border-slate-200 pt-4">

                    @auth
                    <a href="{{ route($dashboardRoute) }}" title="Mi cuenta" aria-label="Mi cuenta" class="nav-icon-link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
                        </svg>

                        <span class="nav-icon-label">
                            Mi cuenta
                        </span>

                        <span class="nav-tooltip">
                            Mi cuenta
                        </span>
                    </a>
                    @else
                    <a href="{{ route('login') }}" title="Iniciar sesión" aria-label="Iniciar sesión" class="nav-icon-link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
                        </svg>

                        <span class="nav-icon-label">
                            Iniciar sesión
                        </span>

                        <span class="nav-tooltip">
                            Iniciar sesión
                        </span>
                    </a>
                    @endauth

                </div>

            </div>
        </div>

    </div>
</header>