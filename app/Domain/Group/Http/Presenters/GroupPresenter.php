<?php

namespace App\Domain\Group\Http\Presenters;

use App\Dto\Group;

class GroupPresenter
{
    /**
     * @param Group[] $groups
     * @return array
     */
    public function collection(array $groups): array
    {
        $collection = [];

        foreach ($groups as $group) {
            $collection[] = $this->single($group);
        }

        return $collection;
    }

    public function single(Group $group): array
    {
        return [
            'id' => $group->getId(),
            'name' => $group->getName(),
            'description' => $group->getDescription()
        ];
    }
}