<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\DatabaseMigrations;


class ParticipateInCourseTest extends TestCase
{
  //use DatabaseMigrations;
  public function setUp()
  {
      parent::setUp();
      create('App\Role', ['name'=>'teacher']);
      create('App\Role', ['name'=>'member']);
      create('App\Role', ['name'=>'manager']);
      create('App\Role', ['name'=>'pending']);
      $this->withoutExceptionHandling();

  }

  /** @test */
  public function unauthenticated_users_cannot_participate()
  {
    $course = create('App\Course');
    $this->withExceptionHandling()
      ->post($course->path().'/enroll')->assertRedirect('/login');
  }

  /** @test */
  public function a_participateInCourse_user_can_participate_in_course()
  {
    $course = create('App\Course');
    $this->assertEquals(0, $course->participants->count());
    $user = $this->createUserWithPermissionTo('participateInCourse');
    $this->signIn($user);
    $this->get($course->path())
      ->assertSee(\App\Teacher::find($course->teacher_id)->first()->last_name)
      ->assertDontSee($user->last_name);
    #$this->assertTrue($user->hasPermission(\App\Permission::whereName('perticipateInCourse')->first()));

    $this->post($course->path() .'/enroll');

    $this->assertEquals(1, $course->participants()->get()->count());

    $this->get($course->path())
          ->assertSee($user->first_name.', '.substr($user->last_name, 0,1));
  }

  /** @test */
  public function a_member_can_give_feedback()
  {
    // given we have an authenticated user
  //  $this->withExceptionHandling();
    $user = create('App\User');
    $user->assignRole('member');
    $user = $this->createUserWithPermissionTo('addFeedback');
    $this->signIn($user);

    $course = create('App\Course');
    $feedback = make('App\CourseFeedback', ['user_id'=>$user->id]);

    $this->post($course->path() .'/feedback', $feedback->toArray());

    $this->get($course->path())
      ->assertSee($feedback->body);
  }

  /** @test */
  public function a_teacher_can_give_feedback()
  {
    // given we have an authenticated user
    $this->withExceptionHandling();
    $user = create('App\User');
    $user->assignRole('teacher');
    $user = $this->createUserWithPermissionTo('addFeedback');
    $this->signIn($user);

    $course = create('App\Course');
    $feedback = make('App\CourseFeedback', ['user_id'=>$user->id]);

    $this->post($course->path() .'/feedback', $feedback->toArray());

    $this->get($course->path())
      ->assertSee($feedback->body);
  }


  /** @test */
  public function an_manager_can_give_feedback()
  {
    // given we have an authenticated user
    $this->withExceptionHandling();
    $user = create('App\User');
    $user->assignRole('manager');
    $user = $this->createUserWithPermissionTo('addFeedback');
    $this->signIn($user);

    $course = create('App\Course');
    $feedback = make('App\CourseFeedback', ['user_id'=>$user->id]);

    $this->post($course->path() .'/feedback', $feedback->toArray());

    $this->get($course->path())
      ->assertSee($feedback->body);
  }

  /** @test */
  public function an_pending_cannot_give_feedback()
  {
    // given we have an authenticated user
    $this->withExceptionHandling();
    $user = create('App\User');
    $user->assignRole('pending');
    $this->signIn($user);

    $course = create('App\Course');
    $feedback = make('App\CourseFeedback', ['user_id'=>$user->id]);

    $this->post($course->path() .'/feedback', $feedback->toArray())->assertStatus(403);

    $this->get($course->path())
      ->assertSee('Please Update your User Information, in order to be approved by the Admins.');
  }
}
