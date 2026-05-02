@extends('layouts.app')

@section('content')
<div class="p-6">

    {{-- Errores generales --}}
    @if($errors->any())
    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
        <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('usuarios.store') }}">
        @csrf

        <input
            type="text"
            name="nombre"
            value="{{ old('nombre') }}"
            placeholder="Nombre"
            class="block mb-1 w-full @error('nombre') border-red-500 @enderror">
        @error('nombre')
        <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
        @enderror

        <input
            type="text"
            name="apellidos"
            value="{{ old('apellidos') }}"
            placeholder="Apellidos"
            class="block mb-1 w-full @error('apellidos') border-red-500 @enderror">
        @error('apellidos')
        <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
        @enderror

        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Email"
            class="block mb-1 w-full @error('email') border-red-500 @enderror">
        @error('email')
        <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
        @enderror

        <select name="role" class="block mb-1 w-full @error('role') border-red-500 @enderror">
            @foreach($roles as $rol)
            <option value="{{ $rol }}" {{ old('role') === $rol ? 'selected' : '' }}>
                {{ ucfirst($rol) }}
            </option>
            @endforeach
        </select>
        @error('role')
        <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
        @enderror

        <input
            type="password"
            name="password"
            placeholder="Contraseña"
            class="block mb-1 w-full @error('password') border-red-500 @enderror">
        @error('password')
        <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
        @enderror

        <input
            type="password"
            name="password_confirmation"
            placeholder="Confirmar contraseña"
            class="block mb-2 w-full">

        <button class="bg-black text-white px-4 py-2">
            Guardar
        </button>
    </form>
</div>
@endsection