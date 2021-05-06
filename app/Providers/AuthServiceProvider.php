<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Group' => 'App\Policies\GroupPolicy',
        'App\Models\Department' => 'App\Policies\DepartmentPolicy',
        'App\Models\File' => 'App\Policies\FilePolicy',
        'App\Models\Task' => 'App\Policies\TaskPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-all-tasks', function (User $user) {
            return $user->group->gCanAcceptTask == 1;
        });
        Gate::define('execute-tasks', function (User $user) {
            return $user->group->gCanPerformTask == 1;
        });
        Gate::define('decline-tasks', function (User $user) {
            return $user->group->gCanCancelTask == 1;
        });
    }
}
