<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Electrónica',
                'descripcion' => 'Dispositivos electrónicos.',
            ],
            [
                'nombre' => 'Computación',
                'descripcion' => 'Equipos de cómputo.',
            ],
            [
                'nombre' => 'Accesorios',
                'descripcion' => 'Accesorios tecnológicos.',
            ],
            [
                'nombre' => 'Oficina',
                'descripcion' => 'Productos de oficina.',
            ],
            [
                'nombre' => 'Electrodomésticos',
                'descripcion' => 'Equipos eléctricos para el hogar.',
            ],
            [
                'nombre' => 'Hogar',
                'descripcion' => 'Productos útiles para uso doméstico.',
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
