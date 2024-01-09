<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('manage-expertise-sv', function (User $user) {
            return $user->role_id == 3;
        });

        Gate::define('manage-expertise-student', function (User $user) {
            return $user->role_id == 2;
        });

        Gate::define('manage-sv-hunting', function (User $user) {
            return $user->role_id ==2;
        });

        Gate::define('manage-title-sv', function (User $user) {
            return $user->role_id ==3;
        });

        Gate::define('manage-title-student', function (User $user) {
            return $user->role_id ==2;
        });

        Gate::define('manage-title-request', function (User $user) {
            return $user->role_id ==2;
        });

        Gate::define('manage-supervisor-request', function (User $user) {
            return $user->role_id ==2;
        });

        Gate::define('manage-approval', function(User $user) {
            return $user->role_id ==3;
        });
    }
}
