<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Gerente\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\Admin\EstadisticaController;
use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;
use App\Models\Categoria;

//PAGINA INICIAL
Route::get('/', function () {
    return view('welcome');
})->name('inicio');




//Perfil
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//CLIENTE
Route::middleware(['auth', 'role:cliente'])->prefix('cliente')->group(function () {

    Route::get('/dashboard', function () {

        $categorias = Categoria::with(['productos' => function ($query) {
            $query->where('existencia', '>', 0);
        }])->get();

        return view('cliente.dashboard', compact('categorias'));
    })->name('dashboard.cliente');

    Route::get('/productos', [ProductoController::class, 'index'])
        ->name('cliente.productos.index');

    Route::get('/ventas', [VentaController::class, 'index'])
        ->name('cliente.ventas.index');

    // CARRITO
    Route::get('/carrito', [CarritoController::class, 'index'])
        ->name('carrito.index');

    Route::post('/carrito/agregar/{producto}', [CarritoController::class, 'agregar'])
        ->name('carrito.agregar');

    Route::patch('/carrito/actualizar/{producto}', [CarritoController::class, 'actualizar'])
        ->name('carrito.actualizar');

    Route::delete('/carrito/eliminar/{producto}', [CarritoController::class, 'eliminar'])
        ->name('carrito.eliminar');

    Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])
        ->name('carrito.vaciar');

    Route::post('/carrito/comprar', [CarritoController::class, 'comprar'])
        ->name('carrito.comprar');

    Route::get('/carrito/comprobante/{referencia}', [CarritoController::class, 'comprobante'])
        ->name('carrito.comprobante');
});




Route::middleware(['auth'])->group(function () {

    // acceso a ticket controlado por Policy
    Route::get('/ventas/{venta}/ticket', [VentaController::class, 'ticket'])
        ->name('ventas.ticket');
});





//INVENTARIO (ADMIN + GERENTE)
Route::middleware(['auth', 'role:administrador,gerente'])->group(function () {

    // INVENTARIO
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
});




//GERENTE
Route::middleware(['auth', 'role:gerente'])->prefix('gerente')->group(function () {

    Route::get('/dashboard', fn() => view('gerente.dashboard'))
        ->name('dashboard.gerente');

    // PRODUCTOS
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');

    // CATEGORIAS
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');

    // VENTAS
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
    Route::patch('/ventas/{venta}/validar', [VentaController::class, 'validar'])
        ->name('ventas.validar');

    // CLIENTES
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/{cliente}/editar', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
});


// ADMIN
Route::middleware(['auth', 'role:administrador'])->prefix('administrador')->group(function () {

    Route::get('/dashboard', [EstadisticaController::class, 'index'])
        ->name('dashboard.administrador');

    // USUARIOS
    Route::resource('usuarios', UserController::class);

    // ELIMINAR PRODUCTOS
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])
        ->name('productos.destroy');

    // ELIMINAR CATEGORIAS
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])
        ->name('categorias.destroy');

    // VER VENTAS
    Route::get('/ventas', [VentaController::class, 'index'])
        ->name('admin.ventas.index');
});


require __DIR__ . '/auth.php';
