@component('mail::message')
# Verificación de identidad

Ingresa este código en la pantalla de verificación.
Expira en **5 minutos**.

@component('mail::panel')
# {{ $codigo }}
@endcomponent

Si no intentaste iniciar sesión, ignora este correo.

{{ config('app.name') }}
@endcomponent