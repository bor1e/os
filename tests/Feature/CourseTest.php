<?php

namespace Tests\Feature;

use App\Course;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CourseTest extends TestCase
{

  public function setUp()
  {
    parent::setUp();
    $this->teacher = create('App\Teacher');
    $this->course = create('App\Course', [
      'date'=>today()->addDays(3),
      'teacher_id'=> $this->teacher->id,
    ]);
    $this->participant = create('App\Participant', [
        'course_id'=>$this->course->id,
      ]);
    $this->singleCourse = create('App\Course', ['date'=>today()->addDays(5)]);
    $this->user = User::find($this->participant->first()->user_id);
  }

    /** @test */
    public function a_user_can_view_all_courses()
    {
        $this->get('/courses')
          ->assertSee($this->singleCourse->title);
    }

    /** @test */
    public function a_user_can_view_one_course()
    {
        $this->get($this->course->path())
          ->assertSee($this->course->title);
    }

    /** @test */
    public function a_user_can_see_the_participants()
    {
      $this->get($this->course->path())
        ->assertSee('('.$this->course->participants()->count().')');
    }

    /** @test */
    public function a_channel_displays_a_course()
    {
      $this->withoutExceptionHandling()->get('/courses/'.$this->course->channel->name)
        ->assertSee($this->course->title)
        ->assertDontSee($this->singleCourse->title);
    }

    /** @test */
    public function a_user_can_filter_courses_by_teachers_lastname()
    {
      $this->get('/courses?by='.$this->teacher->last_name)
        ->assertSee($this->course->title)
        ->assertDontSee($this->singleCourse->title);
    }
}
