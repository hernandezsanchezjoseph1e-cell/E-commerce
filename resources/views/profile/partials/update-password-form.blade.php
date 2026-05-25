<section>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5" novalidate>
        @csrf
        @method('PUT')

        <div>
            <label for="current_password" class="form-label">
                Contraseña actual
            </label>

            <input id="current_password" type="password" name="current_password" autocomplete="current-password" class="form-control">

            @error('current_password')
            <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="form-label">
                Nueva contraseña
            </label>

            <input id="password" type="password" name="password" autocomplete="new-password" class="form-control">

            @error('password')
            <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="form-label">
                Confirmar contraseña
            </label>

            <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" class="form-control">
        </div>

        @if(session('status') === 'password-updated')
        <div class="alert-success">
            Contraseña actualizada correctamente.
        </div>
        @endif

        <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
            <button type="submit" class="btn-primary">
                Guardar contraseña
            </button>
        </div>
    </form>

</section>