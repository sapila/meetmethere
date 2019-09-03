<?php

namespace App\Repositories;

use App\Dto\FriendRequest;

class FriendRequestLaravelRepository extends LaravelRepository implements FriendRequestRepository
{
    public function createFriendRequest(FriendRequest $friendRequest)
    {
        $this->model->create([
            'from_user_id' => $friendRequest->getFromUserId(),
            'to_user_id' => $friendRequest->getToUserId(),
            'status' => $friendRequest->getStatus()
        ]);
    }
}