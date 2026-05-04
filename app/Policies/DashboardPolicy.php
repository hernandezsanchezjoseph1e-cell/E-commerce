<?php

namespace App\Policies;

use App\Models\User;

class DashboardPolicy
{
    public function viewAdminDashboard(User $user): bool
    {
        return $user->role === 'administrador';
    }

    public function viewStats(User $user): bool
    {
        return $user->role === 'administrador';
    }
}
