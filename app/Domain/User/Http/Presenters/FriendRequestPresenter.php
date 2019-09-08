<?php

namespace App\Domain\User\Http\Presenters;

use App\Dto\User;

class FriendRequestPresenter
{

    public function collection(array $friendRequests): array
    {
        $collection = [];

        foreach ($friendRequests as $friendRequest) {
            $collection[] = $this->single($friendRequest);
        }

        return $collection;
    }

    public function single(array $friendRequest): array
    {
        return [
            'id' => $friendRequest['id'],
            'status' => $friendRequest['status'],
            'username' => $friendRequest['user']->getUsername()
        ];
    }
}