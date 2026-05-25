<?php

namespace App\Mail\Ventas;

use App\Models\Venta;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VentaValidadaVendedorMail extends Mailable
{
    use Queueable, SerializesModels;

    public Collection $ventas;

    public Venta $ventaBase;

    public float $total;

    public function __construct(Collection $ventas)
    {
        $this->ventas = $ventas->load(['producto', 'cliente', 'vendedor']);
        $this->ventaBase = $this->ventas->first();
        $this->total = (float) $this->ventas->sum('total');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu venta ha sido registrada',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ventas.vendedor',
            with: [
                'ventas' => $this->ventas,
                'ventaBase' => $this->ventaBase,
                'total' => $this->total,
            ],
        );
    }
}
