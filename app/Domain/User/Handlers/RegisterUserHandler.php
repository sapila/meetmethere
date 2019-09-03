<?php

namespace App\Domain\User\Handlers;

use App\Domain\User\Messages\RegisterUser;
use App\Domain\User\Messages\UserRegistered;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterUserHandler implements ShouldQueue
{

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle user login events.
     */
    public function handle(RegisterUser $event)
    {
        $user = $this->repository->createUser($event->user);
        event(new UserRegistered($user));
    }
}
