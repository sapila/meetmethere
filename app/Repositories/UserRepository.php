<?php

namespace App\Repositories;

use App\Dto\User;

interface UserRepository extends Repository
{
    public function createUser(User $user): User;

    public function addFriendToUser(int $userId, int $friendId): void;

    public function usersAreFriends(int $userId, int $friendId): bool;

    public function findByUsername(string $username): ?User;

    public function findByUsernameLike(string $username): array;

    public function getFriendsOfUser(string $userId): array;
}
