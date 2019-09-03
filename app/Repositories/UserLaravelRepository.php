<?php

namespace App\Repositories;

use App\Dto\User;

class UserLaravelRepository extends LaravelRepository implements UserRepository
{
    public function createUser(User $user)
    {
        $this->model->create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'api_token' => $user->getApiToken()
        ]);
    }
}