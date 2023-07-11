<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    // 
    //  The model to policy mappings for the application.
    //  
    //  @var array<class-string, class-string>
    //  
    // protected $policies = [
    //     //
    // ];

    //
    //  Register any authentication / authorization services.
    //  
    // public function boot(): void
    // {
    //     //
    // }

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('isAdmin', function($user) {
           return $user->role == 'ADMIN';
        });
        Gate::define('isUser', function($user) {
            return $user->role == 'USER';
        });
        Gate::define('update-post', function ($user, $post) {
            return $user->id === $post->user_id;
        });
    }
}
