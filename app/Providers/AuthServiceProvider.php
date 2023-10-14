<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
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
    public function boot()
    {
        $this->registerPolicies();
    
        Gate::define('access-assignment', function ($user, $assignment) {
            // Check if the user is associated with the assignment
            // and if the user is an admin
            return $user->id === $assignment->assigned_to || $this->isAdmin($user);
        });
    }
    
    private function isAdmin($user)
    {
        // Check if the user is an admin based on the guard
        return Auth::guard('admin')->check();
    }
}
