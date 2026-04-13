<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {

        $categorias = [

            ['nombre' => 'Electrónica', 'descripcion' => 'Dispositivos electrónicos'],

            ['nombre' => 'Computación', 'descripcion' => 'Equipos de computo'],

            ['nombre' => 'Accesorios', 'descripcion' => 'Accesorios tecnológicos'],

            ['nombre' => 'Oficina', 'descripcion' => 'Productos de oficina']

        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
