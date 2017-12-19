<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserManagementTest extends TestCase
{
    /** @test */
    public function a_manager_can_see_all_users()
    {
      $user = create('App\User');
      $manager = $this->createUserWithPermissionTo('manageUsers');
      $this->signIn($manager);
      //$user->assignRole('manager');

      $this->get('/shomer/users')
        ->assertSee($user->last_name);
    }

    /** @test */
    public function an_authenticated_user_cannot_access_the_route_users()
    {
      $user = create('App\User');

      $this->signIn($user);
      //$user->assignRole('manager');
      //$this->expectException('Illuminate\Auth\AuthenticationException');
      $this->get('/shomer/users')->assertStatus(403);

    }

    /** @test */
    public function an_authenticated_teacher_cannot_access_the_route_users()
    {
      $teacher = $this->createUserWithPermissionTo('teacher');
      $this->signIn($teacher);
      //$user->assignRole('manager');

      $this->get('/shomer/users')
        ->assertStatus(403);
    }

    /** @test */
    public function not_authenticated_user_cannot_access_shomer_route()
    {
      $this->expectException('Illuminate\Auth\AuthenticationException');
      $this->get('/shomer/10/admin');
    }

}
