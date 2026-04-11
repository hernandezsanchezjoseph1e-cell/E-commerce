@extends('layouts.app')

@section('content')
<div class="p-6">
    <form method="POST" action="{{ route('usuarios.store') }}">
        @csrf

        <input type="text" name="nombre" placeholder="Nombre" class="block mb-2 w-full">

        <input type="text" name="apellidos" placeholder="Apellidos" class="block mb-2 w-full">

        <input type="email" name="email" placeholder="Email" class="block mb-2 w-full">

        <select name="role" class="block mb-2 w-full">
            <option value="cliente">Cliente</option>
            <option value="gerente">Gerente</option>
            <option value="administrador">Administrador</option>
        </select>

        <input type="password" name="password" placeholder="Contraseña" class="block mb-2 w-full">
        <input type="password" name="password_confirmation" placeholder="Confirmar" class="block mb-2 w-full">

        <button class="bg-black text-white px-4 py-2">
            Guardar
        </button>
    </form>
</div>
@endsection