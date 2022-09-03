<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;

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

        //

        Gate::define('view', function(User $user, ){
           if ($user->view==1) {
               return true;
           }
           else{
            return false;
           }
        });

        Gate::define('create', function(User $user, ){
           if ($user->create==1) {
               return true;
           }
           else{
            return false;
           }
        });

        Gate::define('update', function(User $user, ){
           if ($user->update==1) {
               return true;
           }
           else{
            return false;
           }
        });

        Gate::define('delete', function(User $user, ){
           if ($user->delete==1) {
               return true;
           }
           else{
            return false;
           }
        });
      
    }
}
