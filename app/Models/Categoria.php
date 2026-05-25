<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function productos()
    {
        return $this->belongsToMany(
            Producto::class,
            'categoria_producto',
            'categoria_id',
            'producto_id'
        );
    }

    public static function paraDashboardCliente()
    {
        return self::query()
            ->with([
                'productos' => function ($query) {
                    $query->with('usuario')
                        ->disponibles()
                        ->orderBy('nombre');
                },
            ])
            ->orderBy('nombre')
            ->get();
    }
}
