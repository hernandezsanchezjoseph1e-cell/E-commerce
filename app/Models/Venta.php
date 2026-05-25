<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'producto_id',
        'vendedor_id',
        'cliente_id',
        'fecha',
        'cantidad',
        'total',
        'metodo_pago',
        'referencia_pago',
        'codigo_pago',
        'fecha_limite_pago',
        'ticket',
        'validada',
    ];

    protected $casts = [
        'fecha' => 'date',
        'fecha_limite_pago' => 'datetime',
        'total' => 'decimal:2',
        'validada' => 'boolean',
    ];


    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }
}
