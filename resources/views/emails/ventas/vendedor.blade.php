@component('mail::message')
# Venta validada

Hola **{{ $venta->vendedor->nombre }}**, tu venta ha sido validada exitosamente.

## Detalle de la venta

@component('mail::panel')
**Producto:** {{ $producto->nombre }}
**Total:** ${{ number_format($venta->total, 2) }}
@endcomponent

## Datos del comprador

@component('mail::panel')
**Nombre:** {{ $comprador->nombre }} {{ $comprador->apellidos }}
**Email:** {{ $comprador->email }}
@endcomponent

Si tienes alguna duda, puedes contactar al comprador directamente a su correo electrónico.

{{ config('app.name') }}
@endcomponent