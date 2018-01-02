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
    $this->participants = create('App\Participant', [
        'course_id'=>$this->teacher->course_id,
      ]);

    $this->course = Course::find($this->teacher->course_id);
    $this->singleCourse = create('App\Course', ['datetimetz'=>'2019-1-1']);
    $this->user = User::find($this->participants->first()->user_id);
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

      # when we visit the threads we want to see the names of the participants
      $this->get($this->course->path())
        ->assertSee('('.$this->course->participants()->count().')');
    }


    /** @test */
    public function a_channel_displays_a_course()
    {
      $newCourse = create('App\Course');
      $this->withoutExceptionHandling()->get('/courses/'.$this->course->channel->name)
        ->assertSee($this->course->title)
        ->assertDontSee($newCourse->title);
    }

    /** @test */
    public function a_user_can_filter_courses_by_teachers_lastname()
    {
      $this->signIn();
      create('App\Role', ['name'=>'teacher']);
      auth()->user()->assignRole('teacher');
      $my_course = create('App\Course');
      $teacher = create('App\Teacher', ['user_id'=>auth()->id(), 'course_id'=>$my_course->id]);
      $any_course = create('App\Course');
      $this->get('/courses?by='.auth()->user()->last_name)
        ->assertSee($my_course->title)
        ->assertDontSee($any_course->title);
    }
}
