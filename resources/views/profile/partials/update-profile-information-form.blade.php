<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Información del perfil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Actualiza tu información personal.
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">
                Nombre
            </label>

            <input
                id="nombre"
                name="nombre"
                type="text"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                value="{{ old('nombre', $user->nombre) }}"
                required
            >

            @error('nombre')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                Email
            </label>

            <input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                value="{{ old('email', $user->email) }}"
                required
            >

            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
        >
            Guardar
        </button>

        @if(session('success'))
            <p class="text-sm text-green-600">
                {{ session('success') }}
            </p>
        @endif
    </form>
</section>