<?php

namespace App\Providers;

use App\FriendRequest;
use App\Repositories\FriendRequestLaravelRepository;
use App\Repositories\FriendRequestRepository;
use App\Repositories\UserLaravelRepository;
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
