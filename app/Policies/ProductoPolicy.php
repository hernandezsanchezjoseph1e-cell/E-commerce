<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductoPolicy
{
    // Admin y gerente ven la lista
    public function viewAny(User $auth): bool
    {
        return in_array($auth->role, ['administrador', 'gerente']);
    }

    // Solo gerente crea y edita
    public function create(User $auth): bool
    {
        return $auth->role === 'gerente';
    }

    public function update(User $auth, Producto $producto): bool
    {
        return $auth->role === 'gerente';
    }

    // Admin y gerente pueden eliminar
    public function delete(User $auth, Producto $producto): bool
    {
        return in_array($auth->role, ['administrador', 'gerente']);
    }
}
