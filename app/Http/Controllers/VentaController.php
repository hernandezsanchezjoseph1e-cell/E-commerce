<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\User;
use App\Http\Requests\Venta\StoreVentaRequest;
use Illuminate\Support\Facades\Storage;
use App\Mail\Ventas\VentaValidadaVendedorMail;
use App\Mail\Ventas\VentaValidadaCompradorMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VentaController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Venta::class);

        $user = auth()->user();

        $ventas = Venta::with(['producto', 'cliente', 'vendedor'])
            ->when($user->role === 'cliente', function ($query) use ($user) {
                $query->where('cliente_id', $user->id);
            })
            ->get();

        return view(
            $user->role === 'cliente' ? 'cliente.ventas' : 'ventas.index',
            compact('ventas')
        );
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

        $user = auth()->user();

        // AQUÍ SE DEFINE BIEN EL CLIENTE
        $clienteId = $user->role === 'cliente'
            ? $user->id
            : $request->cliente_id;

        $path = null;

        if ($request->hasFile('ticket')) {
            $nombre = Str::uuid() . '.' . $request->file('ticket')->getClientOriginalExtension();
            $path = $request->file('ticket')->storeAs('tickets', $nombre, 'private');
        }

        Venta::create([
            'producto_id' => $producto->id,
            'cliente_id' => $clienteId,
            'vendedor_id' => $user->id,
            'fecha' => now(),
            'total' => $producto->precio,
            'ticket' => $path,
            'validada' => false
        ]);

        $producto->decrement('existencia');

        return redirect()->route('ventas.index');
    }


    public function ticket(Venta $venta)
    {
        $this->authorize('viewTicket', $venta);

        if (!$venta->ticket || !Storage::disk('private')->exists($venta->ticket)) {
            abort(404);
        }

        return response()->file(
            storage_path('app/private/' . $venta->ticket)
        );
    }

    public function validar(Venta $venta)
    {
        $this->authorize('update', $venta);

        $venta->update(['validada' => true]);

        // Cargar relaciones necesarias para los correos
        $venta->load(['producto', 'cliente', 'vendedor']);

        // Correo al vendedor
        Mail::to($venta->vendedor->email)
            ->send(new VentaValidadaVendedorMail($venta));

        // Correo al comprador
        Mail::to($venta->cliente->email)
            ->send(new VentaValidadaCompradorMail($venta));

        return back()->with('success', 'Venta validada y notificaciones enviadas.');
    }
}
