<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Solo el gerente puede gestionar usuarios
    public function __construct()
    {
        $this->middleware('role:gerente');
    }

    // Lista todos los usuarios
    public function index()
    {
        $users = User::orderBy('name')->paginate(15);
        return view('users.index', compact('users'));
    }

    // Formulario para crear usuario
    public function create()
    {
        $roles = [
            User::ROLE_CLIENTE,
            User::ROLE_EMPLEADO,
            User::ROLE_GERENTE,
        ];
        return view('users.create', compact('roles'));
    }

    // Guarda el usuario nuevo
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:cliente,empleado,gerente',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('users.index')
                         ->with('success', 'Usuario creado correctamente.');
    }

    // Formulario para editar
    public function edit(User $user)
    {
        $roles = [
            User::ROLE_CLIENTE,
            User::ROLE_EMPLEADO,
            User::ROLE_GERENTE,
        ];
        return view('users.edit', compact('user', 'roles'));
    }

    // Actualiza el usuario
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:cliente,empleado,gerente',
        ]);

        // Solo actualiza contraseña si se envió una nueva
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
                         ->with('success', 'Usuario actualizado.');
    }

    // Elimina el usuario
    public function destroy(User $user)
    {
        // Evita que el gerente se elimine a sí mismo
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'Usuario eliminado.');
    }
}