@props(['user', 'roles'])

<form method="POST" action="{{ route('usuarios.update', $user) }}" class="space-y-5">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <div>
            <label for="nombre" class="block text-sm font-semibold text-slate-700">
                Nombre
            </label>

            <input id="nombre" type="text" name="nombre" value="{{ old('nombre', $user->nombre) }}" required autofocus autocomplete="nombre" class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('nombre') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">

            @error('nombre')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="apellidos" class="block text-sm font-semibold text-slate-700">
                Apellidos
            </label>

            <input id="apellidos" type="text" name="apellidos" value="{{ old('apellidos', $user->apellidos) }}" required autocomplete="apellidos" class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('apellidos') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">

            @error('apellidos')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="email" class="block text-sm font-semibold text-slate-700">
            Correo electrónico
        </label>

        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" autocomplete="email" class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">

        @error('email')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="role" class="block text-sm font-semibold text-slate-700">
            Rol
        </label>

        <select id="role" name="role" class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('role') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
            @foreach($roles as $role)
            <option value="{{ $role }}" {{ old('role', $user->role) === $role ? 'selected' : '' }}>
                {{ ucfirst($role) }}
            </option>
            @endforeach
        </select>

        @error('role')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
        <a href="{{ route('usuarios.index') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Cancelar
        </a>

        <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-emerald-500/20">
            Actualizar usuario
        </button>
    </div>
</form>