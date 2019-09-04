<?php

namespace App\Providers;

use App\Services\AuthenticationLaravelService;
use App\Services\AuthenticationService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function register()
    {
        parent::register();

        $this->app->bind(AuthenticationService::class, function($app) {
            return new AuthenticationLaravelService();
        });
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
