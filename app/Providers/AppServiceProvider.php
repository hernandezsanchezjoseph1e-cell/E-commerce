<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gates de rol global
        Gate::define('es-admin', fn(User $user) => $user->role === 'administrador');
        Gate::define('es-gerente', fn(User $user) => $user->role === 'gerente');
        Gate::define('es-cliente', fn(User $user) => $user->role === 'cliente');

        // Registrar policies
        //$this->registerPolicies();
    }
}
