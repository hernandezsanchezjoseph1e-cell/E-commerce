<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard Cliente
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/dashboard/cliente', function () {
        return view('dashboard.cliente');
    })->name('dashboard.cliente');
});

// Dashboard Empleado
Route::middleware(['auth', 'role:empleado'])->group(function () {
    Route::get('/dashboard/empleado', function () {
        return view('dashboard.empleado');
    })->name('dashboard.empleado');
});

// Dashboard Gerente + gestión de usuarios
Route::middleware(['auth', 'role:gerente'])->group(function () {
    Route::get('/dashboard/gerente', function () {
        return view('dashboard.gerente');
    })->name('dashboard.gerente');

    Route::resource('users', UserController::class)->except(['show']);
});



require __DIR__.'/auth.php';
