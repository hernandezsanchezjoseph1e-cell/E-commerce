<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class CodigoVerificacion extends Model
{
    protected $table = 'codigos_verificacion';

    protected $fillable = [
        'user_id',
        'codigo',
        'expiracion',
        'usado',
    ];

    protected $casts = [
        'expiracion' => 'datetime',
        'usado'      => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estaExpirado(): bool
    {
        return Carbon::now()->isAfter($this->expiracion);
    }

    public function esValido(): bool
    {
        return !$this->usado && !$this->estaExpirado();
    }
}
