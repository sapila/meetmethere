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
        $this->repository->addFriendToUser(
            $event->friendRequest->getFromUserId(),
            $event->friendRequest->getToUserId()
        );

        $this->repository->addFriendToUser(
            $event->friendRequest->getToUserId(),
            $event->friendRequest->getFromUserId()
        );

        event(new FriendshipEstablished($event->friendRequest));
    }
}
