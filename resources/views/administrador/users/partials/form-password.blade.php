@props(['user'])

<form method="POST" action="{{ route('usuarios.update', $user) }}">
    @csrf
    @method('PUT')

    <!-- Nueva contraseña -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Nueva contraseña</label>
        <input type="password" name="password"
               class="block mt-1 w-full border-gray-300 rounded shadow-sm">
        @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Confirmar contraseña -->
    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
        <input type="password" name="password_confirmation"
               class="block mt-1 w-full border-gray-300 rounded shadow-sm">
    </div>

    <div class="mt-6">
        <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded">
            Cambiar contraseña
        </button>
    </div>
</form>