<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordController;


Route::middleware('guest')->group(function () {

    // Registro
    Route::get('/register', [RegisterController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register']);

    // Login
    Route::get('/login', [LoginController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login']);

    // Verificación OTP - va dentro del grupo middleware('guest')
    Route::get('/verificar-otp', [LoginController::class, 'showVerificacion'])
        ->name('2fa.show');

    Route::post('/verificar-otp', [LoginController::class, 'verificar'])
        ->name('2fa.verificar');

    // Recuperar contraseña
    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPassword'])
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
        ->name('password.store');
});


Route::middleware('auth')->group(function () {

    // Verificación de email
    Route::get('/verify-email', [EmailVerificationController::class, 'showNotice'])
        ->name('verification.notice');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::put('/password', [PasswordController::class, 'update'])
        ->name('password.update');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});
