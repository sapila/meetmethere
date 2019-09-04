<?php

namespace App\Domain\User\Handlers;

use App\Domain\User\Messages\FriendRequestAccepted;
use App\Domain\User\Messages\FriendRequestRejected;
use App\Domain\User\Messages\UpdateFriendRequestStatus;
use App\Dto\FriendRequest;
use App\Repositories\FriendRequestRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateFriendRequestStatusHandler implements ShouldQueue
{
    /**
     * @var FriendRequestRepository
     */
    private $repository;

    public function __construct(FriendRequestRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle user login events.
     * @param UpdateFriendRequestStatus $event
     */
    public function handle(UpdateFriendRequestStatus $event)
    {
        $friendRequest = $this->repository->updateFriendRequestStatus($event->friendRequest->getId(), $event->status);

        if ($event->status === FriendRequest::FRIEND_REQUEST_ACCEPTED) {
            event(new FriendRequestAccepted($friendRequest));
        }

        if ($event->status === FriendRequest::FRIEND_REQUEST_REJECTED) {
            event(new FriendRequestRejected($friendRequest));
        }
    }
}
