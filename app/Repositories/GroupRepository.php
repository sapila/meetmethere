<?php

namespace App\Repositories;

use App\Dto\Group;

interface GroupRepository extends Repository
{
    public function findById(int $id): ?Group;

    public function createGroup(Group $user): Group;

    public function addUserToGroup(int $userId, int $groupId): void;

    public function getUsersForGroup(int $groupId): array;

    public function findByNameLike(string $name): array;
}
