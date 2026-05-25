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
        'fotos',
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

    public function scopeDisponibles($query)
    {
        return $query->where('existencia', '>', 0);
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            $q->where('nombre', 'like', "%{$search}%");
        });
    }

    public function scopeCategoria($query, $categoriaId)
    {
        return $query->when($categoriaId, function ($q) use ($categoriaId) {
            $q->whereHas('categorias', function ($categoriaQuery) use ($categoriaId) {
                $categoriaQuery->where('categorias.id', $categoriaId);
            });
        });
    }

    public function scopeStock($query, $stock)
    {
        return $query->when($stock === 'bajo', function ($q) {
            $q->where('existencia', '<', 5);
        });
    }

    //scope para ver productos publicos en la bienvenida
    public static function destacadosPublicos(int $limite = 6)
    {
        return self::query()
            ->with(['usuario', 'categorias'])
            ->disponibles()
            ->latest()
            ->take($limite)
            ->get();
    }
}
