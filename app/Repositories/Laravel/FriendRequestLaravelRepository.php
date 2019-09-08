<?php

namespace App\Repositories\Laravel;

use App\Dto\FriendRequest;
use App\Dto\UserDto;
use App\Repositories\FriendRequestRepository;
use Illuminate\Support\Facades\DB;

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

    public function findByIdAndFromUserId(int $id, int $fromUserId): ?FriendRequest
    {
        $friendRequest = $this->model->where('id', $id)->where('to_user_id', $fromUserId)->first();

        if (!$friendRequest) {
            return null;
        }

        return $friendRequest->toDto();
    }

    public function findFriendRequestsForUser(int $userId): array
    {
        $result = DB::select(
            DB::raw('
              select friends.* , friend_requests.status, friend_requests.id as friend_request_id
              from users
              inner join friend_requests
                ON users.id = friend_requests.from_user_id
              inner join users as friends
                ON friends.id = friend_requests.to_user_id
              where friend_requests.from_user_id = :userId'),
            ['userId' => $userId]
        );

        return $this->mapFriendRequestsQuery($result);
    }

    public function findFriendInvitesForUser(int $userId): array
    {
        $result = DB::select(
            DB::raw('
              select friends.* , friend_requests.status, friend_requests.id as friend_request_id
              from users
              inner join friend_requests
                ON users.id = friend_requests.to_user_id
              inner join users as friends
                ON friends.id = friend_requests.from_user_id
              where friend_requests.to_user_id = :userId'),
            ['userId' => $userId]
        );

        return $this->mapFriendRequestsQuery($result);
    }

    private function mapFriendRequestsQuery(array $usersQueryResult): array
    {
        $friendRequests = [];
        array_walk($usersQueryResult, function ($item) use (&$friendRequests) {
            $user = new UserDto();
            $user->setId($item->id);
            $user->setEmail($item->email);
            $user->setUsername($item->username);
            $user->setPassword($item->password);
            $user->setApiToken($item->api_token);

            $friendRequests[] = [
                'id' => $item->friend_request_id,
                'status' => $item->status,
                'user' => $user
            ];
        });

        return $friendRequests;
    }
}
