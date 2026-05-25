<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Venta;

class VentaPolicy
{
    /**
     * Administrador → puede ver ventas/tickets.
     * Gerente → solo ventas donde él sea vendedor.
     * Cliente → solo ventas donde él sea comprador.
     */

    // Administrador, gerente y cliente pueden entrar a sus listados de ventas
    public function viewAny(User $auth): bool
    {
        return in_array($auth->role, [
            'administrador',
            'gerente',
            'cliente',
        ]);
    }

    // Ver una venta específica según el rol y relación con la venta
    public function view(User $user, Venta $venta): bool
    {
        if ($user->role === 'administrador') {
            return true;
        }

        if ($user->role === 'gerente') {
            return $user->id === $venta->vendedor_id;
        }

        if ($user->role === 'cliente') {
            return $user->id === $venta->cliente_id;
        }

        return false;
    }

    // Ver ticket según el rol y relación con la venta
    public function viewTicket(User $user, Venta $venta): bool
    {
        if ($user->role === 'administrador') {
            return true;
        }

        if ($user->role === 'gerente') {
            return $user->id === $venta->vendedor_id;
        }

        if ($user->role === 'cliente') {
            return $user->id === $venta->cliente_id;
        }

        return false;
    }

    // Solo gerente registra ventas
    public function create(User $auth): bool
    {
        return $auth->role === 'gerente';
    }

    // Solo el gerente vendedor puede validar sus propias ventas
    public function update(User $user, Venta $venta): bool
    {
        return $user->role === 'gerente'
            && $user->id === $venta->vendedor_id;
    }
}
