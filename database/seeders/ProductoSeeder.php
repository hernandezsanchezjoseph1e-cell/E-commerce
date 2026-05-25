<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $gerentes = User::where('role', User::ROLE_GERENTE)->get();

        if ($gerentes->isEmpty()) {
            return;
        }

        $imagenProducto = 'productos/imagen_ejemplo.jpg';

        $imagenOrigen = database_path('seeders/images/imagen_ejemplo.jpg');

        if (file_exists($imagenOrigen) && ! Storage::disk('public')->exists($imagenProducto)) {
            Storage::disk('public')->put(
                $imagenProducto,
                file_get_contents($imagenOrigen)
            );
        }

        $imagenProducto = $this->prepararImagenProducto();

        $productosEjemplo = [
            [
                'nombre' => 'Laptop Lenovo',
                'descripcion' => 'Laptop para trabajo, estudio y productividad diaria.',
                'precio' => 15000,
                'existencia' => 10,
            ],
            [
                'nombre' => 'Mouse Logitech',
                'descripcion' => 'Mouse inalámbrico ergonómico para oficina.',
                'precio' => 350,
                'existencia' => 50,
            ],
            [
                'nombre' => 'Teclado Mecánico',
                'descripcion' => 'Teclado mecánico para escritura y gaming.',
                'precio' => 1200,
                'existencia' => 20,
            ],
            [
                'nombre' => 'Monitor Samsung',
                'descripcion' => 'Monitor LED de 24 pulgadas para escritorio.',
                'precio' => 2500,
                'existencia' => 15,
            ],
            [
                'nombre' => 'Impresora HP',
                'descripcion' => 'Impresora multifuncional para oficina y hogar.',
                'precio' => 1800,
                'existencia' => 8,
            ],
            [
                'nombre' => 'Disco Duro Externo',
                'descripcion' => 'Disco duro externo de 1TB con conexión USB 3.0.',
                'precio' => 800,
                'existencia' => 25,
            ],
            [
                'nombre' => 'Router TP-Link',
                'descripcion' => 'Router inalámbrico con tecnología WiFi 6.',
                'precio' => 1200,
                'existencia' => 12,
            ],
            [
                'nombre' => 'Webcam Logitech',
                'descripcion' => 'Cámara web Full HD 1080p para videollamadas.',
                'precio' => 400,
                'existencia' => 30,
            ],
            [
                'nombre' => 'Auriculares Sony',
                'descripcion' => 'Audífonos con cancelación de ruido.',
                'precio' => 1500,
                'existencia' => 18,
            ],
            [
                'nombre' => 'Tablet Samsung',
                'descripcion' => 'Tablet de 10 pulgadas para entretenimiento y trabajo.',
                'precio' => 2200,
                'existencia' => 10,
            ],
            [
                'nombre' => 'Licuadora Oster',
                'descripcion' => 'Licuadora para cocina con vaso de vidrio.',
                'precio' => 950,
                'existencia' => 14,
            ],
            [
                'nombre' => 'Microondas LG',
                'descripcion' => 'Horno de microondas compacto para uso doméstico.',
                'precio' => 2800,
                'existencia' => 9,
            ],
            [
                'nombre' => 'Refrigerador Mabe',
                'descripcion' => 'Refrigerador de dos puertas para el hogar.',
                'precio' => 9200,
                'existencia' => 6,
            ],
            [
                'nombre' => 'Lavadora Whirlpool',
                'descripcion' => 'Lavadora automática de carga superior.',
                'precio' => 7600,
                'existencia' => 7,
            ],
            [
                'nombre' => 'Cafetera Hamilton Beach',
                'descripcion' => 'Cafetera eléctrica para uso diario.',
                'precio' => 1100,
                'existencia' => 16,
            ],
            [
                'nombre' => 'Aspiradora Koblenz',
                'descripcion' => 'Aspiradora doméstica para limpieza de interiores.',
                'precio' => 1700,
                'existencia' => 11,
            ],
        ];

        foreach ($gerentes as $gerente) {
            $numProductos = rand(3, 6);

            $productosSeleccionados = collect($productosEjemplo)->random($numProductos);

            foreach ($productosSeleccionados as $productoData) {
                $producto = Producto::create(array_merge($productoData, [
                    'usuario_id' => $gerente->id,
                    'fotos' => $imagenProducto ? [$imagenProducto] : [],
                ]));

                $numCategorias = rand(1, 3);

                $categorias = Categoria::query()
                    ->inRandomOrder()
                    ->take($numCategorias)
                    ->pluck('id');

                $producto->categorias()->attach($categorias);
            }
        }
    }

    private function prepararImagenProducto(): ?string
    {
        $imagenOrigen = database_path('seeders/images/producto-default.jpg');

        $imagenDestino = 'productos/producto-default.jpg';

        if (! file_exists($imagenOrigen)) {
            $this->command?->warn('No se encontró la imagen: database/seeders/images/producto-default.jpg');

            return null;
        }

        if (! Storage::disk('public')->exists($imagenDestino)) {
            Storage::disk('public')->put(
                $imagenDestino,
                file_get_contents($imagenOrigen)
            );
        }

        return $imagenDestino;
    }
}
