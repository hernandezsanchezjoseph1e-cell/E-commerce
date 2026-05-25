<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Categoria;

class DashboardController extends Controller
{
    public function index()
    {
        $categorias = Categoria::paraDashboardCliente();
        return view('cliente.dashboard', compact('categorias'));
    }
}
