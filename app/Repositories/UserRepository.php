<?php

namespace App\Repositories;

use App\Dto\User;

interface UserRepository extends Repository
{
    public function createUser(User $user): User;
}
