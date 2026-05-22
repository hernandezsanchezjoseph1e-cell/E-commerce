<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = User::where('role', User::ROLE_CLIENTE)->get();

        if ($clientes->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 200; $i++) {
            $productosDisponibles = Producto::where('existencia', '>', 0)->get();

            if ($productosDisponibles->isEmpty()) {
                break;
            }

            $cliente = $clientes->random();

            $productoBase = $productosDisponibles->random();

            $vendedorId = $productoBase->usuario_id;

            $productosVenta = Producto::where('usuario_id', $vendedorId)
                ->where('existencia', '>', 0)
                ->inRandomOrder()
                ->limit(rand(1, 4))
                ->get();

            if ($productosVenta->isEmpty()) {
                continue;
            }

            $fecha = Carbon::now()->subDays(rand(0, 30));

            $referenciaPago = 'REF-' . $fecha->format('YmdHis') . '-' . Str::upper(Str::random(6));

            $codigoPago = '750' . $fecha->format('YmdHis') . rand(1000, 9999);

            $metodoPago = collect([
                'oxxo',
                'transferencia',
                'tarjeta',
            ])->random();

            $fechaLimitePago = $fecha->copy()->addDays(2);

            $validada = rand(0, 1);

            DB::transaction(function () use (
                $cliente,
                $productosVenta,
                $fecha,
                $referenciaPago,
                $codigoPago,
                $metodoPago,
                $fechaLimitePago,
                $validada
            ) {
                foreach ($productosVenta as $producto) {
                    $cantidad = rand(1, min(3, $producto->existencia));

                    $subtotal = $producto->precio * $cantidad;

                    Venta::create([
                        'producto_id' => $producto->id,
                        'vendedor_id' => $producto->usuario_id,
                        'cliente_id' => $cliente->id,
                        'fecha' => $fecha,
                        'cantidad' => $cantidad,
                        'total' => $subtotal,
                        'metodo_pago' => $metodoPago,
                        'referencia_pago' => $referenciaPago,
                        'codigo_pago' => $codigoPago,
                        'fecha_limite_pago' => $fechaLimitePago,
                        'ticket' => null,
                        'validada' => $validada,
                    ]);

                    $producto->decrement('existencia', $cantidad);
                }
            });
        }
    }
}
