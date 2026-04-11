<?php

namespace App\Http\Controllers\Gerente;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Gerente\UpdateClienteRequest;

class ClienteController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $clientes = User::where('role', User::ROLE_CLIENTE)
            ->orderBy('nombre')
            ->paginate(15);

        return view('gerente.users_cliente.index', [
            'users' => $clientes
        ]);
    }

    public function edit(User $cliente)
    {
        $this->authorize('update', $cliente);
        return view('gerente.users_cliente.edit', ['user' => $cliente]);
    }

    public function update(UpdateClienteRequest $request, User $cliente)
    {
        $this->authorize('update', $cliente);
        $cliente->update($request->validated());

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }
}
