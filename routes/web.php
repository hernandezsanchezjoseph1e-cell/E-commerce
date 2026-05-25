<?php

use App\Http\Controllers\Admin\EstadisticaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Cliente\DashboardController as ClienteDashboardController;
use App\Http\Controllers\Gerente\ClienteController;
use App\Http\Controllers\Gerente\DashboardController as GerenteDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

/*
 Página inicial
*/

Route::get('/', [HomeController::class, 'index'])->name('inicio');

/*
 Perfil
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
 Cliente
*/

Route::middleware(['auth', 'role:cliente'])->prefix('cliente')->group(function () {
    Route::get('/dashboard', [ClienteDashboardController::class, 'index'])->name('dashboard.cliente');

    Route::get('/productos', [ProductoController::class, 'index'])->name('cliente.productos.index');

    Route::get('/ventas', [VentaController::class, 'index'])->name('cliente.ventas.index');

    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar/{producto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::patch('/carrito/actualizar/{producto}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
    Route::delete('/carrito/eliminar/{producto}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
    Route::post('/carrito/comprar', [CarritoController::class, 'comprar'])->name('carrito.comprar');
    Route::get('/carrito/comprobante/{referencia}', [CarritoController::class, 'comprobante'])->name('carrito.comprobante');
});

/*
 Tickets de venta
*/

Route::middleware('auth')->group(function () {
    Route::get('/ventas/{venta}/ticket', [VentaController::class, 'ticket'])->name('ventas.ticket');
});

/*
 Inventario | Administrador y gerente
*/

Route::middleware(['auth', 'role:administrador,gerente'])->group(function () {
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
});

/*
 Gerente
*/

Route::middleware(['auth', 'role:gerente'])->prefix('gerente')->group(function () {
    Route::get('/dashboard', [GerenteDashboardController::class, 'index'])->name('dashboard.gerente');

    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');

    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');

    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
    Route::patch('/ventas/{venta}/validar', [VentaController::class, 'validar'])->name('ventas.validar');

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/{cliente}/editar', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
});

/*
 Administrador
*/

Route::middleware(['auth', 'role:administrador'])->prefix('administrador')->group(function () {
    Route::get('/dashboard', [EstadisticaController::class, 'index'])->name('dashboard.administrador');

    Route::resource('usuarios', UserController::class)->except(['show']);

    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

    Route::get('/ventas', [VentaController::class, 'index'])->name('admin.ventas.index');
});

require __DIR__ . '/auth.php';
