<?php

namespace Tests\Feature;

use App\Course;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CourseTest extends TestCase
{

  use DatabaseMigrations;
  public function setUp()
  {
    parent::setUp();
    $this->teacher = factory('App\Teacher')->create();
    $this->participants = factory('App\Participant', random_int(3,13))->create(
      [
        'course_id'=>$this->teacher->course_id,
      ]
    );
//    echo $this->teacher->course_id;
    $this->course = Course::find($this->teacher->course_id);
    $this->user = User::find($this->participants->first()->user_id);
  }

    /** @test */
    public function a_user_can_view_all_courses()
    {
        $this->get('/courses')
          ->assertSee($this->course->title);
    }

    /** @test */
    public function a_user_can_view_one_course()
    {
        $this->get('courses/' . $this->course->id)
          ->assertSee($this->course->title);
    }

    /** @test */
    public function a_user_can_see_the_participants()
    {

      # when we visit the threads we want to see the names of the participants
      $this->get('courses/' . $this->course->id)
        ->assertSee($this->user->first_name);
    }
}
