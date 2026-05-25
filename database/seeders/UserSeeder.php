<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        // administrador fijo
        User::create([
            'nombre' => 'Admin',
            'apellidos' => 'Sistema',
            'email' => 'hernandezsanchezjoseph1e@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'administrador'
        ]);

        // 30 vendedores (gerentes)
        User::factory()->count(30)->create(['role' => 'gerente']);

        // 70 compradores (clientes)
        User::factory()->count(70)->create(['role' => 'cliente']);
    }
}
