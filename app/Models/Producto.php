<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'existencia',
        'usuario_id',
        'fotos'
    ];

    protected $casts = [
        'fotos' => 'array',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function categorias()
    {
        return $this->belongsToMany(
            Categoria::class,
            'categoria_producto',
            'producto_id',
            'categoria_id'
        );
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function getIngresosAttribute()
    {
        return $this->ventas()->sum('total');
    }

    public function getUnidadesVendidasAttribute()
    {
        return $this->ventas()->count();
    }
}
