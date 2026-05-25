<section class="space-y-5">

    <div class="alert-danger">
        <p class="font-semibold">
            Zona de riesgo
        </p>

        <p class="mt-1">
            Al eliminar tu cuenta, la acción será permanente. Confirma tu contraseña para continuar.
        </p>
    </div>

    <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-5" novalidate>
        @csrf
        @method('DELETE')

        <div>
            <label for="delete_password" class="form-label">
                Confirma tu contraseña
            </label>

            <input id="delete_password" type="password" name="delete_password" autocomplete="current-password" class="form-control">

            @error('delete_password')
            <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col-reverse gap-3 border-t border-red-200 pt-5 sm:flex-row sm:justify-end">
            <button type="submit" class="btn-danger">
                Eliminar cuenta
            </button>
        </div>
    </form>

</section>