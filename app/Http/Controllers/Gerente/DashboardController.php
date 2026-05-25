<?php

namespace App\Http\Controllers\Gerente;

use App\Http\Controllers\Controller;
use App\Models\Venta;

class DashboardController extends Controller
{
    public function index()
    {
        $ventasPendientes = Venta::contarReferenciasPendientesPorVendedor(auth()->id());
        return view('gerente.dashboard', compact('ventasPendientes'));
    }
}
