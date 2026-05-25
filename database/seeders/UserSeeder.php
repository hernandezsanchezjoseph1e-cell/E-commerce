<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador fijo para datos iniciales del sistema
        User::create([
            'nombre' => 'Admin',
            'apellidos' => 'Sistema',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
        ]);

        // 30 vendedores / gerentes
        User::factory()->count(30)->create([
            'role' => User::ROLE_GERENTE,
        ]);

        // 70 compradores / clientes
        User::factory()->count(70)->create([
            'role' => User::ROLE_CLIENTE,
        ]);
    }
}
