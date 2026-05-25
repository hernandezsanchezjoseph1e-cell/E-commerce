<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileDestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password' => ['required', 'current_password'],
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Debes confirmar tu contraseña.',
            'password.current_password' => 'La contraseña ingresada no es correcta.',
        ];
    }

    public function attributes(): array
    {
        return [
            'password' => 'contraseña',
        ];
    }
}
