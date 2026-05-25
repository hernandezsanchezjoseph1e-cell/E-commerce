<nav x-data="{ open: false }" class="border-b border-slate-200 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex h-16 items-center justify-between">

            <div class="flex items-center">
                <a href="{{ route(auth()->user()->dashboardRouteName()) }}" class="flex flex-col leading-tight">
                    <span class="text-xl font-bold tracking-tight text-slate-900">
                        Tech & Home
                    </span>

                    <span class="hidden text-xs text-slate-500 sm:block">
                        Tecnología para tu hogar
                    </span>
                </a>
            </div>

            <div class="hidden items-center gap-5 md:flex">
                @yield('menu')

                <a href="{{ route('profile.edit') }}" title="Perfil" aria-label="Perfil" class="nav-icon-link {{ request()->routeIs('profile.*') ? 'nav-icon-link-active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
                    </svg>

                    <span class="nav-icon-label">Perfil</span>
                    <span class="nav-tooltip">Perfil</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" title="Cerrar sesión" aria-label="Cerrar sesión" class="nav-icon-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 15l3-3m0 0-3-3m3 3H9" />
                        </svg>

                        <span class="nav-icon-label">Cerrar sesión</span>
                        <span class="nav-tooltip">Cerrar sesión</span>
                    </button>
                </form>
            </div>

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

        <div x-show="open" x-cloak class="border-t border-slate-200 py-3 md:hidden">
            <div class="flex flex-col gap-1">
                @yield('menu')

                <a href="{{ route('profile.edit') }}" title="Perfil" aria-label="Perfil" class="nav-icon-link {{ request()->routeIs('profile.*') ? 'nav-icon-link-active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
                    </svg>

                    <span class="nav-icon-label">Perfil</span>
                    <span class="nav-tooltip">Perfil</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" title="Cerrar sesión" aria-label="Cerrar sesión" class="nav-icon-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 15l3-3m0 0-3-3m3 3H9" />
                        </svg>

                        <span class="nav-icon-label">Cerrar sesión</span>
                        <span class="nav-tooltip">Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </div>

    </div>
</nav>