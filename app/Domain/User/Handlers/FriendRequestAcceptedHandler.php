<?php

namespace App\Domain\User\Handlers;

use App\Domain\User\Messages\FriendRequestAccepted;
use App\Domain\User\Messages\FriendshipEstablished;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class FriendRequestAcceptedHandler implements ShouldQueue
{
    /** @var UserRepository  */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle user login events.
     * @param FriendRequestAccepted $event
     */
    public function handle(FriendRequestAccepted $event)
    {
        $fromUserId = $event->friendRequest->getFromUserId();
        $toUserId =  $event->friendRequest->getToUserId();

        if (!$this->repository->usersAreFriends($fromUserId, $toUserId)) {
            $this->repository->addFriendToUser($fromUserId, $toUserId);
        }

        if (!$this->repository->usersAreFriends($toUserId, $fromUserId)) {
            $this->repository->addFriendToUser($toUserId, $fromUserId);
        }

        event(new FriendshipEstablished($event->friendRequest));
    }
}
