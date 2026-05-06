<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Carbon;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = User::where('role', 'cliente')->get();
        $productos = Producto::where('existencia', '>', 0)->get();

        // Crear algunas ventas aleatorias
        for ($i = 0; $i < 200; $i++) {
            $cliente = $clientes->random();
            $producto = $productos->random();

            if ($producto->existencia > 0) {
                Venta::create([
                    'producto_id' => $producto->id,
                    'vendedor_id' => $producto->usuario_id,
                    'cliente_id' => $cliente->id,
                    'fecha' => Carbon::now()->subDays(rand(0, 30)),
                    'total' => $producto->precio,
                    'ticket' => null, // Sin ticket por ahora
                    'validada' => rand(0, 1) // Algunas validadas, otras no
                ]);

                $producto->decrement('existencia');
            }
        }
    }
}