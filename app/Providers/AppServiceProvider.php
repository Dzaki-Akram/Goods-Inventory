<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    
    public function boot()
    {
        Gate::define('manage-users', function ($user) {
            return $user->role === 'admin';
        });
    
        Gate::define('manage-employees', function ($user) {
            return $user->role === 'admin';
        });
    }
    
}
