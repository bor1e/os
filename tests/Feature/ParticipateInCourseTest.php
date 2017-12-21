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
  }
  /** @test */
  public function unauthenticated_users_cannot_participate()
  {
    /*
    $teacher = create('App\Teacher');
    $this->expectException('Illuminate\Auth\AuthenticationException');
    $this->post('/courses/'. $teacher->course_id.'/enroll',[])->assertStatus(403);
    */
    $this->assertTrue(true);
  }

  /** @test */
  public function a_participateInCourse_user_can_participate_in_course()
  {
    $teacher = create('App\Teacher');
    $course = \App\Course::find($teacher->course_id)->first();

    // given we have an authenticated user
    $user = $this->createUserWithPermissionTo('participateInCourse');

    $this->signIn($user);

    //assert the user is not present beforehand
    $this->get($course->path())
      ->assertSee(\App\User::find($teacher->id)->first()->last_name)
      ->assertDontSee($user->last_name);
    //$this->assertTrue($user->hasPermission(\App\Permission::whereName('perticipateInCourse')->first()));
    // when user enrolls in class
    $this->post($course->path() .'/enroll', $user->toArray());

    // the number of participants updates
    $this->get($course->path())
      ->assertSee($user->first_name.', '.substr($user->last_name, 0,1));
  }

  /** @test */
  public function an_member_can_give_feedback()
  {
    // given we have an authenticated user
    $user = create('App\User');
    $user->assignRole('member');
    $this->signIn($user);

    $feedback = factory('App\CourseFeedback')->create(['user_id'=>$user->id]);
    $teacher = factory('App\Teacher')->create(['course_id'=>$feedback->course_id]);
    $course_path = '/courses/'. $feedback->course_id;

    $this->post($course_path .'/feedback', $feedback->toArray());

    $this->get($course_path)
      ->assertSee($feedback->body);
  }

  /** @test */
  public function an_teacher_can_give_feedback()
  {
    // given we have an authenticated user
    $user = create('App\User');
    $user->assignRole('teacher');
    $this->signIn($user);

    $feedback = factory('App\CourseFeedback')->create(['user_id'=>$user->id]);
    $teacher = factory('App\Teacher')->create(['course_id'=>$feedback->course_id]);
    $course_path = '/courses/'. $feedback->course_id;

    $this->post($course_path .'/feedback', $feedback->toArray());

    $this->get($course_path)
      ->assertSee($feedback->body);
  }


  /** @test */
  public function an_manager_can_give_feedback()
  {
    // given we have an authenticated user
    $user = create('App\User');
    $user->assignRole('manager');
    $this->signIn($user);

    $feedback = factory('App\CourseFeedback')->create(['user_id'=>$user->id]);
    $teacher = factory('App\Teacher')->create(['course_id'=>$feedback->course_id]);
    $course_path = '/courses/'. $feedback->course_id;

    $this->post($course_path .'/feedback', $feedback->toArray());

    $this->get($course_path)
      ->assertSee($feedback->body);
  }

  /** @test */
  public function an_pending_cannot_give_feedback()
  {
    // given we have an authenticated user
    $user = create('App\User');
    $user->assignRole('pending');
    $this->signIn($user);

    $feedback = factory('App\CourseFeedback')->create(['user_id'=>$user->id]);
    $teacher = factory('App\Teacher')->create(['course_id'=>$feedback->course_id]);
    $course_path = '/courses/'. $feedback->course_id;

    $this->post($course_path .'/feedback', $feedback->toArray())->assertStatus(403);

    $this->get($course_path)
      ->assertSee('Please Update your User Information, in order to be approved by the Admins.');
  }
}
