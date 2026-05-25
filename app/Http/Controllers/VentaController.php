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

        $ventasAgrupadas = Venta::registradasAgrupadasParaUsuario($user);

        return view(
            $user->isCliente() ? 'cliente.ventas' : 'ventas.index',
            compact('ventasAgrupadas')
        );
    }

    public function create()
    {
        $this->authorize('create', Venta::class);

        /*
         | Esta vista ya no crea una venta manual.
         | Ahora muestra compras pendientes agrupadas por referencia de pago.
         */
        $ventas = Venta::pendientesAgrupadasPorReferenciaParaVendedor(auth()->id());

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

        $ventas = Venta::pendientesParaRegistrar($venta, auth()->id());

        if ($ventas->isEmpty()) {
            return back()->withErrors([
                'venta' => 'No se encontraron ventas pendientes para registrar.',
            ]);
        }

        Venta::registrarVentasPendientes($ventas);

        $ventaBase = $ventas->first();

        Mail::to($ventaBase->vendedor->email)
            ->send(new VentaValidadaVendedorMail($ventas));

        Mail::to($ventaBase->cliente->email)
            ->send(new VentaValidadaCompradorMail($ventas));

        return back()->with('success', 'Compra registrada correctamente y notificaciones enviadas.');
    }
}
