<?php

namespace App\Domain\Group\Handlers;

use App\Domain\Group\Messages\GroupCreated;
use App\Domain\Group\Messages\CreateGroup;
use App\Dto\GroupDto;
use App\Repositories\GroupRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateGroupHandler implements ShouldQueue
{

    /**
     * @var GroupRepository
     */
    private $repository;

    public function __construct(GroupRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle user login events.
     */
    public function handle(CreateGroup $event)
    {
        $group = new GroupDto();
        $group->setOwnerUserId($event->group->getOwnerUserId());
        $group->setName($event->group->getName());
        $group->setDescription($event->group->getDescription());

        $group = $this->repository->createGroup($group);

        event(new GroupCreated($group));
    }
}
