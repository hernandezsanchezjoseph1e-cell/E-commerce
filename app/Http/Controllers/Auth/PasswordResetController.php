<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class PasswordResetController extends Controller
{
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        Password::sendResetLink($request->only('email'));

        return back()->with('status','Correo enviado');
    }

    public function showResetForm(Request $request)
    {
        return view('auth.reset-password',[
            'request' => $request
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed|min:8'
        ]);

        Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function(User $user) use ($request){
                $user->password = Hash::make($request->password);
                $user->remember_token = Str::random(60);
                $user->save();
            }
        );

        return redirect()->route('login');
    }
}