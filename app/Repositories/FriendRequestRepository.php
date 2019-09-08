<?php

namespace App\Repositories;

use App\Dto\FriendRequest;

interface FriendRequestRepository extends Repository
{
    public function createFriendRequest(FriendRequest $friendRequest): FriendRequest;

    public function updateFriendRequestStatus(int $friendRequestId, string $status): FriendRequest;

    public function findByIdAndFromUserId(int $id, int $fromUserId): ?FriendRequest;

    public function findFriendRequestsForUser(int $userId): array;

    public function findFriendInvitesForUser(int $userId): array;
}
