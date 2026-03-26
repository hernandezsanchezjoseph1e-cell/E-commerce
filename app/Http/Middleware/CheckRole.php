<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Si no está autenticado, manda al login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

         /** @var \App\Models\User $user */
        $user = auth()->user();

        // Si su rol está en los roles permitidos, pasa
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Si no tiene permiso, abort 403
        abort(403, 'No tienes permiso para acceder a esta sección.');
    }
}
