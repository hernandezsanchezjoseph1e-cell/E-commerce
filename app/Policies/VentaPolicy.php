<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Venta;
use Illuminate\Auth\Access\Response;

class VentaPolicy
{
    // Todos lo usuarios ven ventas
    public function viewAny(User $auth): bool
    {
        return in_array($auth->role, ['administrador', 'gerente', 'cliente']);
    }

    public function view(User $user, Venta $venta): bool
    {
        return
            in_array($user->role, ['administrador', 'gerente']) ||
            $user->id === $venta->cliente_id;
    }


    public function viewTicket(User $user, Venta $venta): bool
    {
        return
            $user->role === 'administrador' ||
            $user->role === 'gerente' ||
            $user->id === $venta->cliente_id;
    }


    // Solo gerente registra ventas (él es el vendedor)
    public function create(User $auth): bool
    {
        return $auth->role === 'gerente';
    }

    // Solo gerente puede validar venta
    public function update(User $user, Venta $venta): bool
    {
        return $user->role === 'gerente';
    }
}
