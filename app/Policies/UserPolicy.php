<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    // Admin ve todos los usuarios
    public function viewAny(User $auth): bool
    {
        return in_array($auth->role, ['administrador', 'gerente']);
    }

    // Solo admin crea usuarios
    public function create(User $auth): bool
    {
        return $auth->role === 'administrador';
    }

    // Admin edita a cualquiera
    // Gerente SOLO edita clientes (reemplaza tu if/abort manual)
    public function update(User $auth, User $objetivo): bool
    {
        if ($auth->role === 'administrador') return true;

        if ($auth->role === 'gerente') {
            return $objetivo->role === User::ROLE_CLIENTE;
        }

        return false;
    }

    // Solo admin elimina
    public function delete(User $auth, User $objetivo): bool
    {
        // Previene a eliminarse asi mismo
        if ($auth->id === $objetivo->id) return false;

        return $auth->role === 'administrador';
    }
}
