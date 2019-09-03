<?php

namespace App\Domain\User\Messages;

use App\Dto\FriendRequest;
use App\Dto\User;
use Illuminate\Queue\SerializesModels;

class FriendRequestInitiated
{
    use SerializesModels;

    /** @var User */
    public $fromUser;

    /** @var User */
    public $toUser;

    /** @var FriendRequest */
    public $friendRequest;

    public function __construct(User $fromUser, User $toUser, FriendRequest $friendRequest)
    {
        $this->fromUser = $fromUser;
        $this->toUser = $toUser;
        $this->friendRequest = $friendRequest;
    }
}
