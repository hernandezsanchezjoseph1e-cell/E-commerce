<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $nombres = [
            'Juan',
            'Mario',
            'Maria',
            'Pedro',
            'Ana',
            'Luis',
            'Carmen',
            'Jose',
            'Rosa',
            'Miguel',
        ];

        $apellidos = [
            'Lopez',
            'Sanchez',
            'Hernandez',
            'Martinez',
            'Garcia',
            'Perez',
            'Rodriguez',
            'Gonzalez',
            'Fernandez',
            'Morales',
        ];

        $nombre = $this->faker->randomElement($nombres);
        $apellido = $this->faker->randomElement($apellidos);

        $email = strtolower(
            substr($nombre, 0, 1) .
                $apellido .
                $this->faker->unique()->numberBetween(1, 9999)
        ) . '@tuxtla.tecnm.mx';

        return [
            'nombre' => $nombre,
            'apellidos' => $apellido,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'cliente',
        ];
    }

    public function role(string $role): static
    {
        return $this->state([
            'role' => $role,
        ]);
    }

    public function unverified(): static
    {
        return $this->state([
            'email_verified_at' => null,
        ]);
    }
}
