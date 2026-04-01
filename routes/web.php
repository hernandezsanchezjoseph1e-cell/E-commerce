<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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
