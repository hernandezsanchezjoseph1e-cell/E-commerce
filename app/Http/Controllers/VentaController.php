<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\User;
use App\Http\Requests\Venta\StoreVentaRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        $ticketPath = null;

        if ($request->hasFile('ticket')) {
            $nombre = Str::uuid() . '.' . $request->file('ticket')->getClientOriginalExtension();
            $ticketPath = $request->file('ticket')->storeAs('tickets', $nombre, 'private');
        }

        Venta::create([
            'producto_id' => $producto->id,
            'cliente_id' => $request->cliente_id,
            'vendedor_id' => auth()->id(),
            'fecha' => now(),
            'total' => $producto->precio,
            'ticket' => $ticketPath
        ]);

        $producto->decrement('existencia');

        return redirect()->route('ventas.index');
    }

    public function ticket(Venta $venta)
    {
        $this->authorize('view', $venta);

        if (!$venta->ticket || !Storage::disk('private')->exists($venta->ticket)) {
            abort(404);
        }

        return response()->file(
            storage_path('app/private/' . $venta->ticket)
        );
    }
}
