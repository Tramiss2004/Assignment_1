<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define an administrator user role
        Gate::define('isAdmin', function($user){
            return $user->hasRole('admin');
        });

        // Define an staff user role
        Gate::define('isStaff', function($user){
            return $user->hasRole('staff');
        });

        // Define an user role
        Gate::define('isUser', function($user){
            return $user->hasRole('user');
        });
    }
}
