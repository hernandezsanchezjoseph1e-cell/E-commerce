<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//Authenticatable permite que el usuario pueda iniciar sesion
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // Roles disponibles como constantes (evita typos)
    const ROLE_ADMIN  = 'administrador';
    const ROLE_GERENTE = 'gerente';
    const ROLE_CLIENTE = 'cliente';

    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // helpers

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isGerente(): bool
    {
        return $this->role === self::ROLE_GERENTE;
    }

    public function isCliente(): bool
    {
        return $this->role === self::ROLE_CLIENTE;
    }

    public function hasAdminAccess(): bool
    {
        return in_array($this->role, [
            self::ROLE_ADMIN,
            self::ROLE_GERENTE
        ]);
    }

    //Productos del usuarios
    public function productos()
    {
        return $this->hasMany(Producto::class, 'usuario_id');
    }
    //Ventas como cliente
    public function compras()
    {
        return $this->hasMany(Venta::class, 'cliente_id');
    }
    //Ventas como vendedor
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'vendedor_id');
    }

    public function getCategoriasVendidasAttribute()
    {
        return $this->productos
            ->flatMap->categorias
            ->unique('id')
            ->values();
    }

    //Para obtener estadisticas
    public function totalVentas()
    {
        return $this->ventas()->sum('total');
    }

    public function totalCompras()
    {
        return $this->compras()->sum('total');
    }
}
