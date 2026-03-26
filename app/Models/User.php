<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//notifiable

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // Roles disponibles como constantes (evita typos)
    const ROLE_CLIENTE  = 'cliente';
    const ROLE_EMPLEADO = 'empleado';
    const ROLE_GERENTE  = 'gerente';

    protected $fillable = [
        'name',
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

    // Helpers de rol

    public function isCliente(): bool
    {
        return $this->role === self::ROLE_CLIENTE;
    }

    public function isEmpleado(): bool
    {
        return $this->role === self::ROLE_EMPLEADO;
    }

    public function isGerente(): bool
    {
        return $this->role === self::ROLE_GERENTE;
    }

    // Gerente puede hacer todo lo que hace un empleado también
    public function hasAdminAccess(): bool
    {
        return in_array($this->role, [self::ROLE_EMPLEADO, self::ROLE_GERENTE]);
    }

    //  Scopes (para filtrar en queries)

    public function scopeClientes($query)
    {
        return $query->where('role', self::ROLE_CLIENTE);
    }

    public function scopeEmpleados($query)
    {
        return $query->where('role', self::ROLE_EMPLEADO);
    }

    public function scopeGerentes($query)
    {
        return $query->where('role', self::ROLE_GERENTE);
    }
}