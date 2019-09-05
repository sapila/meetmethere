<?php

namespace App\Providers;

use App\Domain\Group\Messages\CreateGroup;
use App\Domain\Group\Messages\RsvpUserToGroup;
use App\Domain\User\Messages\FriendRequestAccepted;
use App\Domain\User\Messages\InitiateFriendRequest;
use App\Domain\User\Messages\RegisterUser;
use App\Domain\User\Messages\UpdateFriendRequestStatus;
use App\Domain\User\Messages\UserRegistered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RegisterUser::class => [
            'App\Domain\User\Handlers\RegisterUserHandler'
        ],
        UserRegistered::class => [
            'App\Domain\Email\Handlers\UserRegisteredHandler'
        ],
        InitiateFriendRequest::class => [
            'App\Domain\User\Handlers\InitiateFriendRequestHandler'
        ],
        UpdateFriendRequestStatus::class => [
            'App\Domain\User\Handlers\UpdateFriendRequestStatusHandler'
        ],
        FriendRequestAccepted::class => [
            'App\Domain\User\Handlers\FriendRequestAcceptedHandler'
        ],
        CreateGroup::class => [
            'App\Domain\Group\Handlers\CreateGroupHandler'
        ],
        RsvpUserToGroup::class => [
            'App\Domain\Group\Handlers\RsvpUserToGroupHandler'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
