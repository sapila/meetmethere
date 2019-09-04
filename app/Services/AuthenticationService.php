<?php

namespace App\Services;

use App\Dto\User;

interface AuthenticationService
{
    public function getAuthenticatedUser(): ?User;

    public function validate(string $email, string $pass): bool;
}
