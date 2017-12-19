<?php

namespace App\Providers;

use \App\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Course' => 'App\Policies\CoursePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Dynamically register permissions with Laravel's Gate.
      if (app()->environment() !== 'testing') {
        foreach ($this->getPermissions() as $permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }
      }
    }

      /**
      * Fetch the collection of site permissions.
      *
      * @return \Illuminate\Database\Eloquent\Collection
      */
      protected function getPermissions()
      {
        return Permission::with('roles')->get();
      }
}
