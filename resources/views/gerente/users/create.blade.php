<x-app-layout>
    <x-slot name="header">
        <h2>Crear Usuario</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <input type="text" name="name" placeholder="Nombre" class="block mb-2 w-full">

            <input type="email" name="email" placeholder="Email" class="block mb-2 w-full">

            <select name="role" class="block mb-2 w-full">
                <option value="cliente">Cliente</option>
                <option value="empleado">Empleado</option>
                <option value="gerente">Gerente</option>
            </select>

            <input type="password" name="password" placeholder="Contraseña" class="block mb-2 w-full">
            <input type="password" name="password_confirmation" placeholder="Confirmar" class="block mb-2 w-full">

            <button class="bg-black text-white px-4 py-2">
                Guardar
            </button>
        </form>
    </div>
</x-app-layout>