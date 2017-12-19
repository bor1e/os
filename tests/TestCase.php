<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    protected function signIn($user = null)
    {
      $user = $user ?: create('App\User');
      //$this->be($user);
      $this->actingAs($user);

      return $this;
    }

    protected function createUserWithPermissionTo($permissionName, $overrides = [])
    {
    $permission = factory('App\Permission')->create([
        'name' => $permissionName
    ]);

    $user = factory('App\User')->create($overrides);

    \Gate::define($permission->name, function ($user) {
        return true;
    });

    return $user;
  }
}
