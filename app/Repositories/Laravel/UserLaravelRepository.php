<?php

namespace App\Repositories\Laravel;

use App\Dto\User;
use App\Dto\UserDto;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

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

    public function usersAreFriends(int $userId, int $friendId): bool
    {
        /** @var \App\User $user */
        $user = $this->model->where('id', $userId)->first();
        return $user->friends()->where('friend_id', $friendId)->exists();
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
    public function findByUsernameLike(string $username): array
    {
        $collection = $this->model->where('username', 'LIKE', '%' . $username . '%')->get();

        $users = [];
        $collection->each(function ($item, $key) use (&$users) {
            $user = new UserDto();
            $user->setUsername($item->username);
            $user->setEmail($item->email);

            $users[] = $user;
        });

        return $users;
    }

    public function getFriendsOfUser(string $userId): array
    {
        /** @var \App\User $user */
        $user = $this->model->where('id', $userId)->with('friends')->first();

        $friends = [];
        $user->friends->each(function ($item, $key) use (&$friends) {
            $user = new UserDto();
            $user->setUsername($item->username);
            $user->setEmail($item->email);

            $friends[] = $user;
        });

        return $friends;
    }
}
