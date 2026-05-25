<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileDestroyRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    /**
     * Mostrar perfil
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user()
        ]);
    }

    /**
     * Actualizar perfil
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        $user->update($request->validated());

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Actualizar contraseña
     */
    public function updatePassword(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        $user->update([
            'password' => Hash::make($request->validated()['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    /**
     * Eliminar cuenta
     */
    public function destroy(ProfileDestroyRequest $request)
    {
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
