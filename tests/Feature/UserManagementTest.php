<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserManagementTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        create('App\Role', ['name'=>'member']);
        create('App\Role', ['name'=>'pending']);
        create('App\Role', ['name'=>'declined']);
        create('App\Role', ['name'=>'teacher']);

    }

    /** @test */
    public function a_manager_can_see_all_users()
    {
      $manager = $this->createUserWithPermissionTo('manageUsers');
      $user = create('App\User');
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
      $this->withExceptionHandling();
      //$this->expectException('Illuminate\Auth\AuthenticationException');
      $this->get('/shomer/10/admin')->assertStatus(302)->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_who_is_manager_can_assign_role_member()
    {
      $this->withExceptionHandling();
      $user = create('App\User');
      $manager = $this->createUserWithPermissionTo('manageUsers');
      $this->signIn($manager);
      $this->get('/shomer/'.$user->id.'/member');
      $this->assertTrue($user->hasRole('member'));
    }

    /** @test */
    public function an_authenticated_user_who_is_manager_can_assign_role_pending()
    {
      $user = create('App\User');
      $manager = $this->createUserWithPermissionTo('manageUsers');
      $this->signIn($manager);
      $this->get('/shomer/'.$user->id.'/pending');
      $this->assertTrue($user->hasRole('pending'));
    }

    /** @test */
    public function an_authenticated_user_who_is_manager_can_assign_role_declined()
    {
      $user = create('App\User');
      $manager = $this->createUserWithPermissionTo('manageUsers');
      $this->signIn($manager);
      $this->get('/shomer/'.$user->id.'/declined');
      $this->assertTrue($user->hasRole('declined'));
    }

    /** @test */
    public function an_authenticated_user_who_is_manager_can_assign_role_teacher()
    {
      $user = create('App\User');
      $manager = $this->createUserWithPermissionTo('manageUsers');
      $this->signIn($manager);
      $this->get('/shomer/'.$user->id.'/teacher');
      $this->assertTrue($user->hasRole('teacher'));
    }

    /** @test */
    public function an_authenticated_user_who_is_manager_cannot_assign_role_manager()
    {
      $this->withExceptionHandling();
      $user = create('App\User');
      $manager = $this->createUserWithPermissionTo('manageUsers');
      $this->signIn($manager);
      //$this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');
      $response = $this->get('/shomer/'.$user->id.'/manager')->assertStatus(451);
    }
}
