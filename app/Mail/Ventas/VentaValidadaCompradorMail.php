<?php

namespace App\Mail\Ventas;

use App\Models\Venta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VentaValidadaCompradorMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Venta $venta) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu compra ha sido confirmada',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.ventas.comprador',
            with: [
                'venta'    => $this->venta,
                'producto' => $this->venta->producto,
                'vendedor' => $this->venta->vendedor,
            ],
        );
    }
}
