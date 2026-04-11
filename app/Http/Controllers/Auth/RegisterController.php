<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Actions\CreateUser;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Mostrar formulario de registro
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Registrar usuario cliente
     * @throws ValidationException
     */
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nombre'     => 'required|string|max:255',
            'apellidos'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);

        $data['role'] = User::ROLE_CLIENTE;

        $user = User::create($data);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard.cliente');
    }
}