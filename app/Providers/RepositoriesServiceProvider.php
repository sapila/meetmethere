<?php

namespace App\Providers;

use App\FriendRequest;
use App\Group;
use App\Repositories\GroupRepository;
use App\Repositories\Laravel\FriendRequestLaravelRepository;
use App\Repositories\FriendRequestRepository;
use App\Repositories\Laravel\GroupLaravelRepository;
use App\Repositories\Laravel\UserLaravelRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, function($app) {
            return new UserLaravelRepository(new User());
        });

        $this->app->bind(FriendRequestRepository::class, function($app) {
            return new FriendRequestLaravelRepository(new FriendRequest());
        });

        $this->app->bind(GroupRepository::class, function ($app) {
            return new GroupLaravelRepository(new Group());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
