<?php

namespace App\Repositories;

use App\Dto\Group;

interface GroupRepository extends Repository
{
    public function createGroup(Group $user): Group;
}
