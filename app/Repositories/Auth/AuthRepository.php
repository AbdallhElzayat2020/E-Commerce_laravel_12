<?php

namespace App\Repositories\Auth;

use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public function login($credentials, $guard, $remember = false)
    {
        return Auth::guard($guard)->attempt($credentials, $remember);
    }

    public function logout($guard)
    {
        return Auth::guard($guard)->logout();
    }
}
