<?php

namespace Tests\Unit\Domain\User\Handlers;

use App\Domain\User\Handlers\InitiateFriendRequestHandler;
use App\Domain\User\Messages\FriendRequestInitiated;
use App\Domain\User\Messages\InitiateFriendRequest;
use App\Dto\FriendRequestDto;
use App\Dto\UserDto;
use App\Repositories\FriendRequestRepository;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class InitiateFriendRequestHandlerTest extends TestCase
{
    /** @var MockObject|FriendRequestRepository */
    private $friendRequestRepository;

    /** @var UserDto */
    private $fromUser;

    /** @var UserDto */
    private $toUser;

    /** @var InitiateFriendRequest */
    private $event;

    private $friendRequest;

    /**
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->friendRequestRepository = $this->createMock(FriendRequestRepository::class);

        $this->fromUser = new UserDto();
        $this->fromUser->setUsername('firstuser');
        $this->fromUser->setId(1);
        $this->fromUser->setEmail('firstuser@mail.com');

        $this->toUser = new UserDto();
        $this->toUser->setUsername('seconduser');
        $this->toUser->setId(2);
        $this->toUser->setEmail('seconduser@mail.com');

        $this->friendRequest = new FriendRequestDto();
        $this->friendRequest->setFromUserId($this->fromUser->getId());
        $this->friendRequest->setToUserId($this->toUser->getId());
        $this->friendRequest->setStatus('pending');

        $this->event = new InitiateFriendRequest($this->fromUser, $this->toUser);
    }

    public function test_handler_emits_event_with_created_friend_request()
    {
        Event::fake();
        $this->friendRequestRepository->method('createFriendRequest')->willReturn($this->friendRequest);

        $handler = new InitiateFriendRequestHandler($this->friendRequestRepository);
        $handler->handle($this->event);

        Event::assertDispatched(FriendRequestInitiated::class, function ($e) {
            /** @var $e FriendRequestInitiated */
            return $e->friendRequest->getFromUserId() === 1 &&
                   $e->friendRequest->getToUserId() === 2 &&
                   $e->friendRequest->getStatus() === 'pending';
        });
    }
}
