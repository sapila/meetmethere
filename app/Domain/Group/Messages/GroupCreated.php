<?php

namespace App\Domain\Group\Messages;

use App\Dto\Group;
use Illuminate\Queue\SerializesModels;

class GroupCreated
{
    use SerializesModels;
    /**
     * @var Group
     */
    private $group;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }
}
