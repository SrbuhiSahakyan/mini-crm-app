<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected AuthService $authService;
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(LoginRequest $request) {
        $credentials = $request->only('email', 'password');
        if ($this->authService->login($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/tickets');
        }
        return back()->withErrors(['email' => 'Неверный эл почта или пароль']);
    }

    public function logout(Request $request) {
        $this->authService->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
