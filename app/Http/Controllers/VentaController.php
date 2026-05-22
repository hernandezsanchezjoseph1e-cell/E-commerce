<?php

namespace App\Http\Controllers;

use App\Mail\Ventas\VentaValidadaCompradorMail;
use App\Mail\Ventas\VentaValidadaVendedorMail;
use App\Models\Venta;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class VentaController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Venta::class);

        $user = auth()->user();

        $ventas = Venta::with(['producto', 'cliente', 'vendedor'])
            ->when($user->isCliente(), function ($query) use ($user) {
                $query->where('cliente_id', $user->id);
            })
            ->when($user->isGerente(), function ($query) use ($user) {
                $query->where('vendedor_id', $user->id)
                    ->where('validada', true);
            })
            ->when($user->isAdmin(), function ($query) {
                $query->where('validada', true);
            })
            ->latest()
            ->get();

        return view(
            $user->isCliente() ? 'cliente.ventas' : 'ventas.index',
            compact('ventas')
        );
    }

    public function create()
    {
        $this->authorize('create', Venta::class);

        /*
         | Esta vista ya no crea una venta manual.
         | Ahora muestra compras pendientes agrupadas por referencia de pago.
         */
        $ventas = Venta::with(['producto', 'cliente', 'vendedor'])
            ->where('vendedor_id', auth()->id())
            ->where('validada', false)
            ->latest()
            ->get()
            ->groupBy(function ($venta) {
                return $venta->referencia_pago ?? 'SIN_REFERENCIA_' . $venta->id;
            });

        return view('ventas.create', compact('ventas'));
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

        if ($venta->validada) {
            return back()->with('success', 'La venta ya estaba registrada.');
        }

        $query = Venta::with(['producto', 'cliente', 'vendedor'])
            ->where('vendedor_id', auth()->id())
            ->where('validada', false);

        if ($venta->referencia_pago) {
            $query->where('referencia_pago', $venta->referencia_pago);
        } else {
            $query->where('id', $venta->id);
        }

        $ventas = $query->get();

        if ($ventas->isEmpty()) {
            return back()->withErrors([
                'venta' => 'No se encontraron ventas pendientes para registrar.',
            ]);
        }

        Venta::whereIn('id', $ventas->pluck('id'))->update([
            'validada' => true,
        ]);

        $ventas->each(function ($ventaConfirmada) {
            $ventaConfirmada->validada = true;
        });

        $ventaBase = $ventas->first();

        Mail::to($ventaBase->vendedor->email)
            ->send(new VentaValidadaVendedorMail($ventas));

        Mail::to($ventaBase->cliente->email)
            ->send(new VentaValidadaCompradorMail($ventas));

        return back()->with('success', 'Compra registrada correctamente y notificaciones enviadas.');
    }
}
