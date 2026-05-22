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
        'precio' => 'decimal:2',
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

    // Accessor: calcula ingresos subtotales del producto
    public function getIngresosAttribute()
    {
        return $this->ventas()->sum('total');
    }

    // Accessor: obtiene cantidad de unidades vendidas
    public function getUnidadesVendidasAttribute()
    {
        return $this->ventas()->sum('cantidad');
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('nombre', 'like', "%{$search}%");
        }
    }

    public function scopeCategoria($query, $categoriaId)
    {
        if ($categoriaId) {
            $query->whereHas('categorias', function ($q) use ($categoriaId) {
                $q->where('categorias.id', $categoriaId);
            });
        }
    }

    public function scopeStock($query, $stock)
    {
        if ($stock === 'bajo') {
            $query->where('existencia', '<', 5);
        }
    }
}
