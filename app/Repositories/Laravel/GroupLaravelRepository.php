<?php

namespace App\Repositories\Laravel;

use App\Dto\Group;
use App\Repositories\GroupRepository;

class GroupLaravelRepository extends LaravelRepository implements GroupRepository
{
    public function getById(int $id): ?Group
    {
        $group = $this->model->where('id', $id)->first();

        if (!$group) {
            return null;
        }

        return $group->toDto();
    }

    public function createGroup(Group $group): Group
    {
        /** @var \App\Group $group */
        $group = $this->model->create([
            'name' => $group->getName(),
            'description' => $group->getDescription(),
            'owner_user_id' => $group->getOwnerUserId(),
        ]);

        return $group->toDto();
    }

    public function addUserToGroup(int $userId, int $groupId): void
    {
        /** @var \App\Group $group */
        $group = $this->model->where('id', $groupId)->first();
        $group->users()->attach($userId);
    }

    public function getUsersForGroup(int $groupId): array
    {
        $group = $this->model->where('id', $groupId)->with('users')->first();
        return $group->users->toArray();
    }
}
