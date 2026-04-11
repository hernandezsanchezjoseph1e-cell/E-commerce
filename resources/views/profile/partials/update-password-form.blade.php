<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Cambiar contraseña
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Usa una contraseña segura.
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">
                Contraseña actual
            </label>

            <input
                type="password"
                name="current_password"
                class="mt-1 block w-full border-gray-300 rounded-md"
            >

            @error('current_password')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">
                Nueva contraseña
            </label>

            <input
                type="password"
                name="password"
                class="mt-1 block w-full border-gray-300 rounded-md"
            >

            @error('password')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">
                Confirmar contraseña
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="mt-1 block w-full border-gray-300 rounded-md"
            >
        </div>

        <button
            type="submit"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
        >
            Guardar contraseña
        </button>
    </form>
</section>