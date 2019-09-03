<?php

namespace App\Repositories;

use App\Dto\FriendRequest;

interface FriendRequestRepository extends Repository
{
    public function createFriendRequest(FriendRequest $friendRequest);
}
