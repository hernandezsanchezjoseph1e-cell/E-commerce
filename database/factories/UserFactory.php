<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $nombres = ['Juan', 'Mario', 'Maria', 'Pedro', 'Ana', 'Luis', 'Carmen', 'Jose', 'Rosa', 'Miguel'];
        $apellidos = ['Lopez', 'Sanchez', 'Hernandez', 'Martinez', 'Garcia', 'Perez', 'Rodriguez', 'Gonzalez', 'Fernandez', 'Morales'];

        $nombre = $this->faker->randomElement($nombres);
        $apellido = $this->faker->randomElement($apellidos);

        $email = strtolower(substr($nombre, 0, 1) . $apellido . $this->faker->unique()->numberBetween(1, 9999))
            . '@tuxtla.tecnm.mx';

        return [

            'nombre' => $nombre,
            'apellidos' => $apellido,
            'email' => $email,
            'password' => Hash::make('123'),
            'role' => $this->faker->randomElement(['cliente', 'gerente'])

        ];
    }

    public function role(string $role)
    {
        return $this->state(['role' => $role]);
    }
}
