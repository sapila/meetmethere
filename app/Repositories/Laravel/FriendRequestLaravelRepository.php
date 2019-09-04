<?php

namespace App\Repositories\Laravel;

use App\Dto\FriendRequest;
use App\Repositories\FriendRequestRepository;

class FriendRequestLaravelRepository extends LaravelRepository implements FriendRequestRepository
{
    public function createFriendRequest(FriendRequest $friendRequest): FriendRequest
    {
        $friendRequest = $this->model->create([
            'from_user_id' => $friendRequest->getFromUserId(),
            'to_user_id' => $friendRequest->getToUserId(),
            'status' => $friendRequest->getStatus()
        ]);

        return $friendRequest->toDto();
    }

    public function updateFriendRequestStatus(int $friendRequestId, string $status): FriendRequest
    {
        $friendRequest = $this->model->where('id', $friendRequestId)->first();
        $friendRequest->status = $status;
        $friendRequest->save();

        return $friendRequest->toDto();
    }

    public function findForIdAndFromUserId(int $id, int $fromUserId): ?FriendRequest
    {
        $friendRequest = $this->model->where('id', $id)->where('to_user_id', $fromUserId)->first();

        if (!$friendRequest) {
            return null;
        }

        return $friendRequest->toDto();
    }
}
