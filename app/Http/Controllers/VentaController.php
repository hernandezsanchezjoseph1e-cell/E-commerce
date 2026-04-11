<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\User;
use App\Http\Requests\Venta\StoreVentaRequest;

class VentaController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Venta::class);
        $ventas = Venta::with(['producto', 'cliente', 'vendedor'])->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $this->authorize('create', Venta::class);
        $productos = Producto::all();
        $clientes = User::where('role', 'cliente')->get();

        return view('ventas.create', compact('productos', 'clientes'));
    }

    public function store(StoreVentaRequest $request)
    {
        $this->authorize('create', Venta::class);
        $producto = Producto::findOrFail($request->producto_id);

        if ($producto->existencia <= 0) {
            throw new \Exception('Sin inventario');
        }

        Venta::create([
            'producto_id' => $producto->id,
            'cliente_id' => $request->cliente_id,
            'vendedor_id' => auth()->id(),
            'fecha' => now(),
            'total' => $producto->precio
        ]);

        $producto->decrement('existencia');

        return redirect()->route('ventas.index');
    }
}
