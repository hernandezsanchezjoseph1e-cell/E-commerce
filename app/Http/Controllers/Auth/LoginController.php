<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\CodigoVerificacionMail;
use App\Models\CodigoVerificacion;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Mostrar formulario de login
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Procesar login
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        // Las reglas de 'rules()' ya corrieron automáticamente.
        // Esto solo valida credenciales sin crear sesión:
        $request->validarCredenciales();

        $user = User::where('email', $request->email)->first();

        Log::channel('autenticacion')->info('Login fase 1 correcto', [
            'usuario_id' => $user->id,
            'email'      => $user->email,
            'ip'         => $request->ip(),
        ]);

        CodigoVerificacion::where('user_id', $user->id)->delete();

        $codigo = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        CodigoVerificacion::create([
            'user_id'    => $user->id,
            'codigo'     => $codigo,
            'expiracion' => Carbon::now()->addMinutes(5),
            'usado'      => false,
        ]);

        Mail::to($user->email)->send(new CodigoVerificacionMail($codigo));

        Log::channel('autenticacion')->info('Codigo 2FA generado', [
            'usuario_id' => $user->id,
            'ip'         => $request->ip(),
        ]);

        session(['2fa_user_id' => $user->id]);

        return redirect()->route('2fa.show')
            ->with('status', 'Código enviado a ' . $user->email);
    }

    // ──────────────────────────────────────────────────────────
    // PASO 2: Mostrar formulario OTP
    // ──────────────────────────────────────────────────────────
    public function showVerificacion(): View|RedirectResponse
    {
        // Si alguien entra directo a esta URL sin pasar por login, redirigir
        if (!session('2fa_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.verificacion-otp');
    }

    // ──────────────────────────────────────────────────────────
    // PASO 3: Verificar OTP → iniciar sesión real
    // ──────────────────────────────────────────────────────────
    public function verificar(Request $request): RedirectResponse
    {
        $request->validate([
            'codigo' => ['required', 'digits:6'],
        ]);

        $userId = session('2fa_user_id');

        if (!$userId) {
            return redirect()->route('login')
                ->withErrors(['codigo' => 'Sesión expirada. Inicia sesión de nuevo.']);
        }

        $claveRateLimit = '2fa_intentos_' . $userId;

        if (RateLimiter::tooManyAttempts($claveRateLimit, 5)) {
            $segundos = RateLimiter::availableIn($claveRateLimit);
            return back()->withErrors([
                'codigo' => "Demasiados intentos fallidos. Espera {$segundos} segundos.",
            ]);
        }

        $registro = CodigoVerificacion::where('user_id', $userId)
            ->where('usado', false)
            ->latest()
            ->first();

        //LOG de Codigo incorrecto o no existe
        if (!$registro || $registro->codigo !== $request->codigo) {
            RateLimiter::hit($claveRateLimit, 600);

            Log::channel('autenticacion')->warning('Codigo 2FA invalido', [
                'usuario_id' => $userId,
                'ip'         => $request->ip(),
            ]);

            return back()->withErrors(['codigo' => 'Código incorrecto.']);
        }

        //LOG de Codigo expirado
        if ($registro->estaExpirado()) {
            Log::channel('autenticacion')->warning('Codigo 2FA expirado', [
                'usuario_id' => $userId,
                'ip'         => $request->ip(),
            ]);

            return back()->withErrors([
                'codigo' => 'El código ha expirado. Vuelve a iniciar sesión para recibir uno nuevo.',
            ]);
        }

        //LOG Código validado correctamente
        Log::channel('autenticacion')->info('Codigo 2FA validado correctamente', [
            'usuario_id' => $userId,
            'ip'         => $request->ip(),
        ]);

        $registro->update(['usado' => true]);
        RateLimiter::clear($claveRateLimit);
        session()->forget('2fa_user_id');

        $user = User::find($userId);
        Auth::login($user);
        $request->session()->regenerate();

        $redirect = match ($user->role) {
            'administrador' => route('dashboard.administrador'),
            'gerente'       => route('dashboard.gerente'),
            default         => route('dashboard.cliente'),
        };

        return redirect()->intended($redirect);
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
