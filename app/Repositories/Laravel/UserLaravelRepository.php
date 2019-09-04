<?php

namespace App\Repositories\Laravel;

use App\Dto\User;
use App\Repositories\UserRepository;

class UserLaravelRepository extends LaravelRepository implements UserRepository
{
    public function createUser(User $user): User
    {
        /** @var \App\User $user */
        $user = $this->model->create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'api_token' => $user->getApiToken()
        ]);

        return $user->toDto();
    }

    public function addFriendToUser(int $userId, int $friendId): void
    {
        /** @var \App\User $user */
        $user = $this->model->where('id', $userId)->first();
        $user->friends()->attach($friendId);
    }
}
