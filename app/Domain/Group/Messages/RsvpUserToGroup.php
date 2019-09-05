<?php

namespace App\Domain\Group\Messages;

use App\Dto\Group;
use App\Dto\User;
use Illuminate\Queue\SerializesModels;

class RsvpUserToGroup
{
    use SerializesModels;
    /**
     * @var User
     */
    public $user;

    /**
     * @var Group
     */
    public $group;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Group $group)
    {
        $this->user = $user;
        $this->group = $group;
    }
}
