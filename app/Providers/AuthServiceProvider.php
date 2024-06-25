<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\RolePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', [RolePolicy::class, 'isAdmin']);
        Gate::define('librarian', [RolePolicy::class, 'isLibrarian']);
        Gate::define('client', [RolePolicy::class, 'isClient']);
    }
}
