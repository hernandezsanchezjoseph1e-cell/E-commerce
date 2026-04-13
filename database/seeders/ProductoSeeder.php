<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\User;
use App\Models\Categoria;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {

        $gerente = User::where('role', 'gerente')->first();

        $productos = [

            [
                'nombre' => 'Laptop Lenovo',
                'descripcion' => 'Laptop para trabajo',
                'precio' => 15000,
                'existencia' => 10
            ],

            [
                'nombre' => 'Mouse Logitech',
                'descripcion' => 'Mouse inalámbrico',
                'precio' => 350,
                'existencia' => 50
            ],

            [
                'nombre' => 'Teclado Mecánico',
                'descripcion' => 'Teclado gamer',
                'precio' => 1200,
                'existencia' => 20
            ]

        ];

        foreach ($productos as $producto) {

            $p = Producto::create([
                ...$producto,
                'usuario_id' => $gerente->id
            ]);

            $categorias = Categoria::inRandomOrder()->take(2)->pluck('id');

            $p->categorias()->attach($categorias);
        }
    }
}
