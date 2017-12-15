<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ParticipateInCourseTest extends TestCase
{
  use DatabaseMigrations;

  /** @test */
  public function unauthenticated_users_cannot_participate()
  {
    $this->expectException('Illuminate\Auth\AuthenticationException');
    $this->post('/courses/1/enroll',[]);
  }

  /** @test */
  public function an_authenticated_user_can_participate_in_course()
  {
    // given we have an authenticated user
    $user = factory('App\User')->create();
    $this->signIn($user);

    // and an existing course
    $teacher = factory('App\Teacher')->create();
    $course_path = '/courses/'. $teacher->course_id;

    //assert the user is not present beforehand
    $this->get($course_path)
      ->assertDontSee($user->last_name);

    // when user enrolls in class
    $this->post($course_path .'/enroll', $user->toArray());

    // the number of participants updates
    $this->get($course_path)
      ->assertSee($user->last_name);

  }

  /** @test */
  public function an_authenticated_user_can_give_feedback()
  {

    // given we have an authenticated user
    $user = factory('App\User')->create();
    $this->signIn($user);

    $feedback = factory('App\CourseFeedback')->create(['user_id'=>$user->id]);
    $course_path = '/courses/'. $feedback->course_id;

    $this->post($course_path .'/feedback', $feedback->toArray());

    $this->get($course_path)
      ->assertSee($feedback->body);

  /*  // TODO:
    $this->assertTrue(true);
*/
  }
}
