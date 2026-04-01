@props(['user'])

<form method="POST" action="{{ route('users.update', $user) }}">
    @csrf
    @method('PUT')

    <!-- Password -->
    <div>
        <x-input-label value="Nueva contraseña" />
        <x-text-input type="password" name="password" class="block w-full mt-1" />
    </div>

    <div class="mt-4">
        <x-input-label value="Confirmar contraseña" />
        <x-text-input type="password" name="password_confirmation" class="block w-full mt-1" />
    </div>

    <div class="mt-6">
        <x-primary-button>
            Cambiar contraseña
        </x-primary-button>
    </div>
</form>