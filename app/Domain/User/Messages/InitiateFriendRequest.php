<?php

namespace App\Domain\User\Messages;

use App\Dto\User;
use Illuminate\Queue\SerializesModels;

class InitiateFriendRequest
{
    use SerializesModels;

    /**
     * @var User
     */
    public $fromUser;

    /**
     * @var User
     */
    public $toUser;

    public function __construct(User $fromUser, User $toUser)
    {
        //
        $this->fromUser = $fromUser;
        $this->toUser = $toUser;
    }
}
