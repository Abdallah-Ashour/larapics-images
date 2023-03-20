<?php

namespace App\Providers;

use App\Enums\Role;
use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\PolicyForImage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        // Image::class => PolicyForImage::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('update-image', [PolicyForImage::class, 'update']);
        // Gate::define('delete-image', [PolicyForImage::class, 'delete']);

        /*
        Gate::define('update-image', function(User $user, Image $image){
             return $user->id === $image->user_id || $user->role === Role::Editor;
        });

        Gate::define('delete-image', function(User $user, Image $image){
            return $user->id === $image->user_id;
       });

       Gate::before(function($user, $ability){
        if($user->role === Role::Admin){
            return true;
        }
        //  return $user->role === Role::Admin ? true : false;
       });
      */
    }// end of function
}
