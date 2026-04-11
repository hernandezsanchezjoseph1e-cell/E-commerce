<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Venta;
use Illuminate\Auth\Access\Response;

class VentaPolicy
{
    // Admin y gerente ven ventas
    public function viewAny(User $auth): bool
    {
        return in_array($auth->role, ['administrador', 'gerente']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Venta $venta): bool
    {
        return false;
    }

    // Solo gerente registra ventas (él es el vendedor)
    public function create(User $auth): bool
    {
        return $auth->role === 'gerente';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Venta $venta): bool
    {
        return false;
    }
}
