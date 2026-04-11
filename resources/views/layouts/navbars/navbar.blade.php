<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between">

        <!-- Logo -->
        <div class="shrink-0 flex items-center">
            <a href="{{ route('inicio') }}">
                <h1 class="text-3xl font-bold text-gray-800">
                    Quessini
                </h1>
            </a>
        </div>

        <!-- Menú dinámico -->
        <div class="flex items-center gap-4">

            @yield('menu')

            <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-gray-900">
                Perfil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-gray-600 hover:text-gray-900">
                    Cerrar sesión
                </button>
            </form>

        </div>

    </div>
</nav>