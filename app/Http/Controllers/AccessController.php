<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
class AccessController extends Controller
{
    public function RegisterPage() {
        return view('access.registo');
    }

    public function RegisterProcess(Request $request) {
        // Validação
        $validator = Validator::make($request->all(), [
            'nome_utilizador' => 'required|string|max:255',
            'senha_utilizador' => 'required|string|min:8|confirmed', // Adicione o campo de confirmação no formulário
            'email_utilizador' => 'required|string|email|max:255|unique:users,email',
            'telefone_utilizador' => 'required|string|max:15',
            'idade_utilizador' => 'required|date',
            'bilhete_utilizador' => 'required|string|max:20',
            'nivel_utilizador' => 'required|integer|in:1,2',
            'terms' => 'accepted'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Criação do usuário
        $user = new User();
        $user->name = $request->nome_utilizador;
        $user->password = Hash::make($request->senha_utilizador);
        $user->email = $request->email_utilizador;
        $user->telefone = $request->telefone_utilizador;
        $user->idade = $request->idade_utilizador;
        $user->bilhete = $request->bilhete_utilizador;
        $user->nivel = $request->nivel_utilizador;
        $user->save();

        // Redirecionar ou fazer login automaticamente
        return redirect()->route('login')->with('success', 'Registro realizado!');
    }
    public function LoginPage() {
        return view('access.login');
    }

    public function LoginProcess(Request $request) {
        // Validação
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tentativa de login
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Redireciona para o dashboard ou página inicial
            return redirect()->intended('home');
        }

        // Redireciona de volta com erro
        return redirect()->back()->with('error', 'Credenciais inválidas!')->withInput();
    }

    public function showForgotPasswordForm() {
        return view('access.email');
    }

    public function sendResetLinkEmail(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm($token) {
        return view('access.reset', ['token' => $token]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                $user->setRememberToken(Str::random(60));

                Auth::login($user);
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
