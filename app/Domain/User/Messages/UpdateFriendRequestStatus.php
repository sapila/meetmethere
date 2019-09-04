<?php

namespace App\Domain\User\Messages;

use App\Dto\FriendRequest;
use Illuminate\Queue\SerializesModels;

class UpdateFriendRequestStatus
{
    use SerializesModels;

    /**
     * @var FriendRequest
     */
    public $friendRequest;

    /**
     * @var string
     */
    public $status;

    public function __construct(FriendRequest $friendRequest, string $status)
    {
        $this->friendRequest = $friendRequest;
        $this->status = $status;
    }
}
