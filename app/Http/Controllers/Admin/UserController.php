<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::orderBy('nombre')->paginate(15);
        return view('administrador.users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);
        $roles = [
            User::ROLE_CLIENTE,
            User::ROLE_GERENTE,
            User::ROLE_ADMIN,
        ];

        return view('administrador.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $usuario)
    {
        $this->authorize('update', $usuario);
        $roles = [
            User::ROLE_CLIENTE,
            User::ROLE_GERENTE,
            User::ROLE_ADMIN,
        ];

        return view('administrador.users.edit', [
            'user' => $usuario,
            'roles' => $roles
        ]);
    }

    public function update(UpdateUserRequest $request, User $usuario)
    {
        $this->authorize('update', $usuario);

        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $usuario->update($data);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario actualizado.');
    }

    public function destroy(User $usuario)
    {
        $this->authorize('delete', $usuario);
        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado.');
    }
}
