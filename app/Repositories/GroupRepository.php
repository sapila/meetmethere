<?php

namespace App\Repositories;

use App\Dto\Group;

interface GroupRepository extends Repository
{
    public function getById(int $id): ?Group;

    public function createGroup(Group $user): Group;

    public function addUserToGroup(int $userId, int $groupId): void;
}
