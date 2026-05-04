<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\User;

use App\Policies\VentaPolicy;
use App\Policies\ProductoPolicy;
use App\Policies\CategoriaPolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Venta::class     => VentaPolicy::class,
        Producto::class  => ProductoPolicy::class,
        Categoria::class => CategoriaPolicy::class,
        User::class      => UserPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
