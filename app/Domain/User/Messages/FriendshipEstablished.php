<?php

namespace App\Domain\User\Messages;

use App\Dto\FriendRequest;
use Illuminate\Queue\SerializesModels;

class FriendshipEstablished
{
    use SerializesModels;

    /**
     * @var FriendRequest
     */
    public $friendRequest;

    public function __construct(FriendRequest $friendRequest)
    {
        $this->friendRequest = $friendRequest;
    }
}