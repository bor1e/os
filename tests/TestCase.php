<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;

    protected function signIn($user = null)
    {
      $user = $user ?: create('App\User');
      //$this->be($user);
      $this->actingAs($user);

      return $this;
    }
}
