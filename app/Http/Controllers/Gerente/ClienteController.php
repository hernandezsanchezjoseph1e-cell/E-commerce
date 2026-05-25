<?php

namespace App\Http\Controllers\Gerente;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gerente\UpdateClienteRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $search = $request->input('search');

        $clientes = User::where('role', User::ROLE_CLIENTE)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%")
                        ->orWhere('apellidos', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('nombre')
            ->paginate(15)
            ->withQueryString();

        return view('gerente.users_cliente.index', [
            'users' => $clientes,
        ]);
    }

    public function edit(User $cliente)
    {
        $this->authorize('update', $cliente);

        return view('gerente.users_cliente.edit', [
            'user' => $cliente,
        ]);
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
