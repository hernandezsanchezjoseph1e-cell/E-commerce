@props(['user', 'roles'])

<form method="POST" action="{{ route('usuarios.update', $user) }}">
    @csrf
    @method('PUT')

    <!-- Nombre -->
    <div>
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input id="nombre" type="text" name="nombre"
               value="{{ old('nombre', $user->nombre) }}"
               required autofocus autocomplete="nombre"
               class="block mt-1 w-full border-gray-300 rounded shadow-sm">
        @error('nombre')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Apellidos -->
    <div class="mt-4">
        <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
        <input id="apellidos" type="text" name="apellidos"
               value="{{ old('apellidos', $user->apellidos) }}"
               required autocomplete="apellidos"
               class="block mt-1 w-full border-gray-300 rounded shadow-sm">
        @error('apellidos')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email -->
    <div class="mt-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input id="email" type="email" name="email"
               value="{{ old('email', $user->email) }}"
               class="block mt-1 w-full border-gray-300 rounded shadow-sm">
        @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Rol -->
    <div class="mt-4">
        <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
        <select name="role" id="role" class="block mt-1 w-full border-gray-300 rounded shadow-sm">
            @foreach($roles as $role)
                <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>
                    {{ ucfirst($role) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mt-6">
        <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded">
            Actualizar
        </button>
    </div>
</form>