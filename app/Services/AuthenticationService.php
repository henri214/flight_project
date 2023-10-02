<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationService
{
    public function store(array $userData)
    {
        $user=User::create($userData);
        
    }
    public function update(array $userData,User $user)
    {
        $user->create($userData);

    }
    public function authenticate()
    {
        //
    }
    public function attemtLogin($credentials) {
        return Auth::attempt($credentials);
    }
}
