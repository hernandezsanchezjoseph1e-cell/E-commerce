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
            'email' => 'admin@tuxtla.tecnm.mx',
            'password' => Hash::make('123'),
            'role' => 'administrador'
        ]);

        // usuarios generados por factory
        User::factory()->count(10)->create();
    }
}
