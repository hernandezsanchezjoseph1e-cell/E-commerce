<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = Session::get('carrito', []);

        if (!is_array($carrito)) {
            $carrito = [];
        }

        $productos = Producto::with('usuario')
            ->whereIn('id', array_keys($carrito))
            ->get()
            ->map(function ($producto) use ($carrito) {
                $cantidad = $carrito[$producto->id]['cantidad'] ?? 1;

                $producto->cantidad_carrito = $cantidad;
                $producto->subtotal_carrito = $producto->precio * $cantidad;

                return $producto;
            });

        $total = $productos->sum('subtotal_carrito');

        return view('carrito.index', compact('productos', 'total'));
    }

    public function agregar(Request $request, Producto $producto)
    {
        $request->validate([
            'cantidad' => ['nullable', 'integer', 'min:1'],
        ]);

        if ($producto->existencia <= 0) {
            return back()->withErrors([
                'producto' => 'Este producto no tiene inventario disponible.',
            ]);
        }

        $cantidad = (int) $request->input('cantidad', 1);

        $carrito = Session::get('carrito', []);

        if (!is_array($carrito)) {
            $carrito = [];
        }

        /*
         | Regla de negocio:
         | El carrito solo puede contener productos de un mismo vendedor.
         */
        if (!empty($carrito)) {
            $primerProductoId = array_key_first($carrito);

            $primerProducto = Producto::find($primerProductoId);

            if ($primerProducto && $primerProducto->usuario_id !== $producto->usuario_id) {
                return back()->withErrors([
                    'carrito' => 'Tu carrito ya contiene productos de otro vendedor. Finaliza o vacía el carrito antes de agregar este producto.',
                ]);
            }
        }

        $cantidadActual = $carrito[$producto->id]['cantidad'] ?? 0;
        $nuevaCantidad = $cantidadActual + $cantidad;

        if ($nuevaCantidad > $producto->existencia) {
            return back()->withErrors([
                'cantidad' => 'No puedes agregar más unidades de las disponibles.',
            ]);
        }

        $carrito[$producto->id] = [
            'cantidad' => $nuevaCantidad,
        ];

        Session::put('carrito', $carrito);

        return back()->with('success', 'Producto agregado al carrito.');
    }

    public function actualizar(Request $request, Producto $producto)
    {
        $request->validate([
            'cantidad' => ['required', 'integer', 'min:1'],
        ]);

        $cantidad = (int) $request->cantidad;

        if ($cantidad > $producto->existencia) {
            return back()->withErrors([
                'cantidad' => 'La cantidad supera el inventario disponible.',
            ]);
        }

        $carrito = Session::get('carrito', []);

        if (!is_array($carrito)) {
            $carrito = [];
        }

        if (!isset($carrito[$producto->id])) {
            return back();
        }

        $carrito[$producto->id]['cantidad'] = $cantidad;

        Session::put('carrito', $carrito);

        return back()->with('success', 'Carrito actualizado.');
    }

    public function eliminar(Producto $producto)
    {
        $carrito = Session::get('carrito', []);

        if (!is_array($carrito)) {
            $carrito = [];
        }

        unset($carrito[$producto->id]);

        Session::put('carrito', $carrito);

        return back()->with('success', 'Producto eliminado del carrito.');
    }


    public function vaciar()
    {
        Session::forget('carrito');

        return back()->with('success', 'Carrito vaciado.');
    }

    public function comprar(Request $request)
    {
        $request->validate([
            'metodo_pago' => ['required', 'in:oxxo,transferencia,tarjeta'],
        ]);

        $carrito = Session::get('carrito', []);

        if (!is_array($carrito) || empty($carrito)) {
            return back()->withErrors([
                'carrito' => 'El carrito está vacío.',
            ]);
        }

        $productos = Producto::with('usuario')
            ->whereIn('id', array_keys($carrito))
            ->get();

        if ($productos->isEmpty()) {
            return back()->withErrors([
                'carrito' => 'No se encontraron productos válidos en el carrito.',
            ]);
        }

        /*
         | Seguridad extra:
         | Aunque ya se valida al agregar, aquí volvemos a comprobar
         | que todos los productos sean del mismo vendedor.
         */
        if ($productos->pluck('usuario_id')->unique()->count() > 1) {
            return back()->withErrors([
                'carrito' => 'El carrito contiene productos de distintos vendedores. Vacía el carrito e intenta de nuevo.',
            ]);
        }

        $metodoPago = $request->metodo_pago;
        $referenciaPago = 'REF-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(6));
        $codigoPago = '750' . now()->format('YmdHis') . random_int(1000, 9999);
        $fechaLimitePago = now()->addDays(2);

        try {
            DB::transaction(function () use (
                $productos,
                $carrito,
                $metodoPago,
                $referenciaPago,
                $codigoPago,
                $fechaLimitePago
            ) {
                foreach ($productos as $producto) {
                    $cantidad = $carrito[$producto->id]['cantidad'] ?? 1;

                    if ($producto->existencia < $cantidad) {
                        throw new \Exception("No hay suficiente inventario para {$producto->nombre}.");
                    }

                    $subtotal = $producto->precio * $cantidad;

                    Venta::create([
                        'producto_id' => $producto->id,
                        'vendedor_id' => $producto->usuario_id,
                        'cliente_id' => Auth::id(),
                        'fecha' => now(),
                        'cantidad' => $cantidad,
                        'total' => $subtotal,
                        'metodo_pago' => $metodoPago,
                        'referencia_pago' => $referenciaPago,
                        'codigo_pago' => $codigoPago,
                        'fecha_limite_pago' => $fechaLimitePago,
                        'ticket' => null,
                        'validada' => false,
                    ]);

                    $producto->decrement('existencia', $cantidad);
                }
            });
        } catch (\Exception $e) {
            return back()->withErrors([
                'carrito' => $e->getMessage(),
            ]);
        }

        Session::forget('carrito');

        return redirect()
            ->route('carrito.comprobante', $referenciaPago)
            ->with('success', 'Orden de pago generada correctamente.');
    }

    public function comprobante(string $referencia)
    {
        $ventas = Venta::with(['producto', 'vendedor'])
            ->where('cliente_id', Auth::id())
            ->where('referencia_pago', $referencia)
            ->get();

        if ($ventas->isEmpty()) {
            abort(404);
        }

        $total = $ventas->sum('total');

        return view('carrito.comprobante', compact('ventas', 'total', 'referencia'));
    }
}
