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
            'username' => $user->getUsername(),
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

    public function findByUsername(string $username): ?User
    {
        /** @var \App\User $user */
        $user = $this->model->where('username', $username)->first();

        if (!$user) {
            return null;
        }

        return $user->toDto();
    }
}
