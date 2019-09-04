<?php

namespace App\Services;

use App\Dto\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationLaravelService implements AuthenticationService
{
    public function getAuthenticatedUser(): ?User
    {
        $user = Auth::user();

        if (!$user) {
            return null;
        }

        return $user->toDto();
    }

    public function validate(string $email, string $pass): bool
    {
        return Auth::validate([
            'email' => $email,
            'password' => $pass
        ]);
    }
}
