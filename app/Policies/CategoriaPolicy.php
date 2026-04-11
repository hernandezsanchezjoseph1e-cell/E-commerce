<?php

namespace App\Policies;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoriaPolicy
{
    public function viewAny(User $auth): bool
    {
        return in_array($auth->role, ['administrador', 'gerente']);
    }

    public function create(User $auth): bool
    {
        return $auth->role === 'gerente';
    }

    public function update(User $auth, Categoria $categoria): bool
    {
        return $auth->role === 'gerente';
    }

    public function delete(User $auth, Categoria $categoria): bool
    {
        return in_array($auth->role, ['administrador', 'gerente']);
    }
}
