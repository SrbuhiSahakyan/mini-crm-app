<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials) {
        return Auth::attempt($credentials);
    }

    public function logout() {
        Auth::logout();
    }
}
