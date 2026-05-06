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
        $gerentes = User::where('role', 'gerente')->get();

        $productosEjemplo = [
            ['nombre' => 'Laptop Lenovo', 'descripcion' => 'Laptop para trabajo', 'precio' => 15000, 'existencia' => 10],
            ['nombre' => 'Mouse Logitech', 'descripcion' => 'Mouse inalámbrico', 'precio' => 350, 'existencia' => 50],
            ['nombre' => 'Teclado Mecánico', 'descripcion' => 'Teclado gamer', 'precio' => 1200, 'existencia' => 20],
            ['nombre' => 'Monitor Samsung', 'descripcion' => 'Monitor 24 pulgadas', 'precio' => 2500, 'existencia' => 15],
            ['nombre' => 'Impresora HP', 'descripcion' => 'Impresora multifuncional', 'precio' => 1800, 'existencia' => 8],
            ['nombre' => 'Disco Duro Externo', 'descripcion' => '1TB USB 3.0', 'precio' => 800, 'existencia' => 25],
            ['nombre' => 'Router TP-Link', 'descripcion' => 'Router WiFi 6', 'precio' => 1200, 'existencia' => 12],
            ['nombre' => 'Webcam Logitech', 'descripcion' => '1080p HD', 'precio' => 400, 'existencia' => 30],
            ['nombre' => 'Auriculares Sony', 'descripcion' => 'Con cancelación de ruido', 'precio' => 1500, 'existencia' => 18],
            ['nombre' => 'Tablet Samsung', 'descripcion' => '10 pulgadas', 'precio' => 2200, 'existencia' => 10],
        ];

        foreach ($gerentes as $gerente) {
            // Cada gerente tiene al menos 3 productos
            $numProductos = rand(3, 6);
            $productosSeleccionados = collect($productosEjemplo)->random($numProductos);

            foreach ($productosSeleccionados as $productoData) {
                $producto = Producto::create(array_merge($productoData, [
                    'usuario_id' => $gerente->id
                ]));

                // Cada producto tiene al menos 1 categoría
                $numCategorias = rand(1, 3);
                $categorias = Categoria::inRandomOrder()->take($numCategorias)->pluck('id');
                $producto->categorias()->attach($categorias);
            }
        }
    }
}
