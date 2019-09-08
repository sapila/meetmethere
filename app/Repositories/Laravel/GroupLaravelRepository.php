<?php

namespace App\Repositories\Laravel;

use App\Dto\Group;
use App\Dto\GroupDto;
use App\Dto\UserDto;
use App\Repositories\GroupRepository;

class GroupLaravelRepository extends LaravelRepository implements GroupRepository
{
    public function findById(int $id): ?Group
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

        $users = [];

        $group->users->each(function ($item, $key) use (&$users) {
            $user = new UserDto();
            $user->setUsername($item->username);
            $user->setEmail($item->email);

            $users[] = $user;
        });

        return $users;
    }

    public function findByNameLike(string $name): array
    {
        $collection = $this->model->where('name', 'LIKE', '%' . $name . '%')->get();

        $groups = [];
        $collection->each(function ($item, $key) use (&$groups) {
            $group = new GroupDto();
            $group->setId($item->id);
            $group->setName($item->name);
            $group->setDescription($item->description);
            $group->setOwnerUserId($item->owner_user_id);
            $groups[] = $group;
        });

        return $groups;
    }
}
