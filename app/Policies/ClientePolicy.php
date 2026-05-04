<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Venta;

class ClientePolicy
{
    public function viewOwnSales(User $user): bool
    {
        return $user->role === 'cliente';
    }

    public function viewOwnTicket(User $user, Venta $venta): bool
    {
        return $user->id === $venta->cliente_id;
    }
}
