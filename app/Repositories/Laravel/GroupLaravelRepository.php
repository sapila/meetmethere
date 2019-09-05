<?php

namespace App\Repositories\Laravel;

use App\Dto\Group;
use App\Repositories\GroupRepository;

class GroupLaravelRepository extends LaravelRepository implements GroupRepository
{
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
}
