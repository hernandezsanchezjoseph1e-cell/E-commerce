<?php

namespace App\Models;

use App\Models\User;
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

    public function scopeConRelacionesPrincipales($query)
    {
        return $query->with([
            'producto',
            'cliente',
            'vendedor',
        ]);
    }

    public function scopeDelCliente($query, $clienteId)
    {
        return $query->where('cliente_id', $clienteId);
    }

    public function scopeDelVendedor($query, $vendedorId)
    {
        return $query->where('vendedor_id', $vendedorId);
    }

    public function scopeValidadas($query)
    {
        return $query->where('validada', true);
    }

    public function scopePendientes($query)
    {
        return $query->where('validada', false);
    }

    public function scopeConReferencia($query)
    {
        return $query->whereNotNull('referencia_pago');
    }

    public static function registradasParaUsuario(User $user)
    {
        return self::query()
            ->conRelacionesPrincipales()
            ->when($user->isCliente(), function ($query) use ($user) {
                $query->delCliente($user->id);
            })
            ->when($user->isGerente(), function ($query) use ($user) {
                $query->delVendedor($user->id)
                    ->validadas();
            })
            ->when($user->isAdmin(), function ($query) {
                $query->validadas();
            })
            ->latest()
            ->get();
    }

    public static function contarReferenciasPendientesPorVendedor($vendedorId)
    {
        return self::query()
            ->delVendedor($vendedorId)
            ->pendientes()
            ->conReferencia()
            ->distinct()
            ->count('referencia_pago');
    }

    public static function pendientesAgrupadasPorReferenciaParaVendedor($vendedorId)
    {
        return self::query()
            ->conRelacionesPrincipales()
            ->delVendedor($vendedorId)
            ->pendientes()
            ->latest()
            ->get()
            ->groupBy(function ($venta) {
                return $venta->referencia_pago ?? 'SIN_REFERENCIA_' . $venta->id;
            });
    }

    public static function pendientesParaRegistrar(Venta $venta, int $vendedorId)
    {
        return self::query()
            ->conRelacionesPrincipales()
            ->delVendedor($vendedorId)
            ->pendientes()
            ->when($venta->referencia_pago, function ($query) use ($venta) {
                $query->where('referencia_pago', $venta->referencia_pago);
            }, function ($query) use ($venta) {
                $query->where('id', $venta->id);
            })
            ->get();
    }

    public static function registrarVentasPendientes($ventas): void
    {
        $ventas->each(function ($venta) {
            $venta->update([
                'validada' => true,
            ]);
        });
    }

    public static function claveReferencia(Venta $venta): string
    {
        return $venta->referencia_pago ?? 'SIN_REFERENCIA_' . $venta->id;
    }

    public static function registradasAgrupadasParaUsuario(User $user)
    {
        return self::registradasParaUsuario($user)
            ->groupBy(function ($venta) {
                return self::claveReferencia($venta);
            })
            ->map(function ($grupoVentas, $referencia) {
                return [
                    'referencia' => $referencia,
                    'venta_base' => $grupoVentas->first(),
                    'ventas' => $grupoVentas,
                    'total' => $grupoVentas->sum('total'),
                    'registrada' => $grupoVentas->every(fn($venta) => $venta->validada),
                ];
            });
    }
}
