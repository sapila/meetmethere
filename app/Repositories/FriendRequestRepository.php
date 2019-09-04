<?php

namespace App\Repositories;

use App\Dto\FriendRequest;

interface FriendRequestRepository extends Repository
{
    public function createFriendRequest(FriendRequest $friendRequest): FriendRequest;

    public function updateFriendRequestStatus(int $friendRequestId, string $status): FriendRequest;

    public function findForIdAndFromUserId(int $id, int $fromUserId): ?FriendRequest;
}
