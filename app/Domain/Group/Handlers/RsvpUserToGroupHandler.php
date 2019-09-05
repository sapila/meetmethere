<?php

namespace App\Domain\Group\Handlers;

use App\Domain\Group\Messages\RsvpUserToGroup;
use App\Domain\Group\Messages\UserRsvpedToGroup;
use App\Repositories\GroupRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class RsvpUserToGroupHandler implements ShouldQueue
{
    /**
     * @var GroupRepository
     */
    private $groupRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function handle(RsvpUserToGroup $event)
    {
        $this->groupRepository->addUserToGroup(
            $event->user->getId(),
            $event->group->getId()
        );

        event(new UserRsvpedToGroup($event->user, $event->group));
    }
}
