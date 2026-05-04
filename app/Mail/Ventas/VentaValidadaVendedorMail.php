<?php

namespace App\Mail\Ventas;

use App\Models\Venta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VentaValidadaVendedorMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Venta $venta) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu venta ha sido validada',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.ventas.vendedor',
            with: [
                'venta'    => $this->venta,
                'producto' => $this->venta->producto,
                'comprador' => $this->venta->cliente,
            ],
        );
    }
}
