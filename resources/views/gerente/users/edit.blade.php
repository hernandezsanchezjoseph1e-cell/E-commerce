<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Editar Usuario: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="p-6 space-y-6">

        <div class="bg-white p-6 rounded shadow">
            <h3 class="font-semibold mb-4">Información del usuario</h3>

            @include('gerente.users.partials.form-profile', [
                'user' => $user,
                'roles' => $roles
            ])

        </div>

        

    </div>
</x-app-layout>