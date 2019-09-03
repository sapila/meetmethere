<?php

namespace App\Domain\User\Handlers;

use App\Domain\User\Messages\FriendRequestInitiated;
use App\Domain\User\Messages\InitiateFriendRequest;
use App\Dto\FriendRequestDto;
use App\Repositories\FriendRequestRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class InitiateFriendRequestHandler implements ShouldQueue
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
     */
    public function handle(InitiateFriendRequest $event)
    {
        $friendRequest = new FriendRequestDto();
        $friendRequest->setFromUserId($event->fromUser->getId());
        $friendRequest->setToUserId($event->toUser->getId());
        $friendRequest->setStatus('pending');

        $friendRequest = $this->repository->createFriendRequest($friendRequest);

        event(new FriendRequestInitiated($event->fromUser, $event->toUser, $friendRequest));
    }
}
