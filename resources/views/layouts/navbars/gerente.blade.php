<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between">

        <!-- Logo -->
        <div class="shrink-0 flex items-center">
            <a href="{{ route('inicio') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            </a>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('users.index') }}">Usuarios</a>

            <a href="{{ route('profile.edit') }}">Perfil</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button>Cerrar sesión</button>
            </form>
        </div>

    </div>
</nav>