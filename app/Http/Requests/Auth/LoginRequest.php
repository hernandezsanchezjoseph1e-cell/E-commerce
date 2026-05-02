<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Valida credenciales SIN iniciar sesión.
     * Usado en el flujo 2FA para verificar email+password
     * antes de enviar el OTP.
     */
    public function validarCredenciales(): void
    {
        if (!Auth::validate($this->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => 'Credenciales incorrectas.',
            ]);
        }
    }

    /**
     * Inicia sesión directamente (sin 2FA).
     * Mantenido por si lo necesitas en otro contexto.
     */
    public function authenticate(): void
    {
        if (!Auth::attempt($this->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => 'Credenciales incorrectas.',
            ]);
        }
    }
}
