@props(['user', 'roles'])

<form method="POST" action="{{ route('users.update', $user) }}">
    @csrf
    @method('PUT')

    <!-- Nombre -->
    <div>
        <x-input-label for="name" value="Nombre" />
        <x-text-input name="name" :value="old('name', $user->name)" class="block w-full mt-1" />
        <x-input-error :messages="$errors->get('name')" />
    </div>

    <!-- Email -->
    <div class="mt-4">
        <x-input-label for="email" value="Email" />
        <x-text-input name="email" type="email" :value="old('email', $user->email)" class="block w-full mt-1" />
        <x-input-error :messages="$errors->get('email')" />
    </div>

    <!-- Rol -->
    <div class="mt-4">
        <x-input-label for="role" value="Rol" />
        <select name="role" class="block w-full mt-1 border-gray-300 rounded">
            @foreach($roles as $role)
                <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>
                    {{ ucfirst($role) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mt-6">
        <x-primary-button>
            Actualizar
        </x-primary-button>
    </div>
</form>