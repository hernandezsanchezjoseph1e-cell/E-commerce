<section>

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-5" novalidate>
        @csrf
        @method('PATCH')

        <div class="form-grid">
            <div>
                <label for="nombre" class="form-label">
                    Nombre
                </label>

                <input id="nombre" name="nombre" type="text" value="{{ old('nombre', $user->nombre) }}" class="form-control">

                @error('nombre')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="apellidos" class="form-label">
                    Apellidos
                </label>

                <input id="apellidos" name="apellidos" type="text" value="{{ old('apellidos', $user->apellidos) }}" class="form-control">

                @error('apellidos')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="email" class="form-label">
                Correo electrónico
            </label>

            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" readonly class="form-control cursor-not-allowed bg-slate-100 text-slate-500">

            <p class="mt-2 text-xs text-slate-500">
                El correo electrónico no se puede modificar desde el perfil.
            </p>
        </div>

        <div>
            <label for="role" class="form-label">
                Rol
            </label>

            <input id="role" type="text" value="{{ ucfirst($user->role) }}" readonly class="form-control cursor-not-allowed bg-slate-100 text-slate-500">
        </div>

        @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
            <button type="submit" class="btn-primary">
                Guardar cambios
            </button>
        </div>
    </form>

</section>