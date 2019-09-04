<?php

namespace App\Domain\Group\Messages;

use App\Dto\Group;
use Illuminate\Queue\SerializesModels;

class CreateGroup
{
    use SerializesModels;

    /**
     * @var Group
     */
    public $group;

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
