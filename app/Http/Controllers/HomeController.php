<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class HomeController extends Controller
{
    public function index()
    {
        $productosDestacados = Producto::destacadosPublicos(6);
        return view('welcome', compact('productosDestacados'));
    }
}
