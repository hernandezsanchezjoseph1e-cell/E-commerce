<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::truncate(); // limpia toda la tabla

        User::create([
            'nombre' => 'Admin',
            'apellidos' => 'Sistema',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'administrador',
        ]);
    }
}