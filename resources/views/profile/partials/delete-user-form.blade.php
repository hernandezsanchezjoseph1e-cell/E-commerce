<section class="space-y-6">

    <header>
        <h2 class="text-lg font-medium text-red-600">
            Eliminar cuenta
        </h2>

        <p class="text-sm text-gray-600">
            Esta acción eliminará permanentemente tu cuenta.
        </p>
    </header>

    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('DELETE')

        <div>
            <label class="block text-sm font-medium text-gray-700">
                Confirma tu contraseña
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

        <button
            type="submit"
            class="mt-4 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
        >
            Eliminar cuenta
        </button>

    </form>

</section>