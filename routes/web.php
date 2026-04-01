<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('inicio');
<<<<<<< HEAD
=======


>>>>>>> da64e1f5e1b6f3e01e0cab36df2ea2ee85aa718d

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

<<<<<<< HEAD
Route::middleware(['auth'])->group(function () {

    Route::prefix('cliente')->middleware('role:cliente')->group(function () {
        Route::get('/dashboard', fn() => view('cliente.dashboard'))
            ->name('dashboard.cliente');
    });

    Route::prefix('empleado')->middleware('role:empleado')->group(function () {
        Route::get('/dashboard', fn() => view('empleado.dashboard'))
            ->name('dashboard.empleado');
    });

    Route::prefix('gerente')->middleware('role:gerente')->group(function () {
        Route::get('/dashboard', fn() => view('gerente.dashboard'))
            ->name('dashboard.gerente');

        Route::resource('users', UserController::class);
    });

});

require __DIR__.'/auth.php';
=======

Route::middleware(['auth'])->group(function () {

    Route::prefix('cliente')->middleware('role:cliente')->group(function () {
        Route::get('/dashboard', fn() => view('cliente.dashboard'))
            ->name('dashboard.cliente');
    });

    Route::prefix('empleado')->middleware('role:empleado')->group(function () {
        Route::get('/dashboard', fn() => view('empleado.dashboard'))
            ->name('dashboard.empleado');
    });

    Route::prefix('gerente')->middleware('role:gerente')->group(function () {
        Route::get('/dashboard', fn() => view('gerente.dashboard'))
            ->name('dashboard.gerente');

        Route::resource('users', UserController::class);
    });

});



require __DIR__.'/auth.php';
>>>>>>> da64e1f5e1b6f3e01e0cab36df2ea2ee85aa718d
