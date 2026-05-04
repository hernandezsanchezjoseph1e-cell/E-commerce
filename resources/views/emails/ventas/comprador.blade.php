@component('mail::message')
# Compra confirmada

Hola **{{ $venta->cliente->nombre }}**, tu compra ha sido confirmada exitosamente.

## Detalle de tu compra

@component('mail::panel')
**Producto:** {{ $producto->nombre }}
**Total:** ${{ number_format($venta->total, 2) }}
@endcomponent

## Datos del vendedor

@component('mail::panel')
**Nombre:** {{ $vendedor->nombre }} {{ $vendedor->apellidos }}
**Email:** {{ $vendedor->email }}
@endcomponent

Para coordinar la entrega o resolver cualquier duda, contacta directamente
a tu vendedor en: **{{ $vendedor->email }}**

{{ config('app.name') }}
@endcomponent