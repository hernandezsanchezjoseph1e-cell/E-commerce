<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Gates de roles globales
        Gate::define(
            'es-admin',
            fn(User $user) =>
            $user->role === 'administrador'
        );

        Gate::define(
            'es-gerente',
            fn(User $user) =>
            $user->role === 'gerente'
        );

        Gate::define(
            'es-cliente',
            fn(User $user) =>
            $user->role === 'cliente'
        );
    }
}
