<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;

class EstadisticaController extends Controller
{
    public function index()
    {
        $this->authorize('es-admin');

        $totalUsuarios = User::count();

        $totalVendedores = User::where('role', User::ROLE_GERENTE)->count();

        $totalCompradores = User::where('role', User::ROLE_CLIENTE)->count();

        $productosPorCategoria = Categoria::with('productos.ventas.cliente')->get();

        $topCompradorPorCategoria = $productosPorCategoria->map(function ($categoria) {

            $clientes = [];

            foreach ($categoria->productos as $producto) {
                foreach ($producto->ventas as $venta) {
                    $clientes[$venta->cliente_id] =
                        ($clientes[$venta->cliente_id] ?? 0) + 1;
                }
            }

            arsort($clientes);

            $topId = array_key_first($clientes);

            return [
                'categoria' => $categoria->nombre,
                'cliente' => $topId ? User::find($topId) : null,
            ];
        });

        $productoMasVendido = Producto::withCount('ventas')
            ->orderByDesc('ventas_count')
            ->first();

        return view('administrador.dashboard', [
            'totalUsuarios' => $totalUsuarios,
            'totalVendedores' => $totalVendedores,
            'totalCompradores' => $totalCompradores,

            'productosPorCategoria' => $productosPorCategoria,
            'productoMasVendido' => $productoMasVendido,
            'topCompradorPorCategoria' => $topCompradorPorCategoria,
        ]);
    }
}
