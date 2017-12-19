<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCourseTest extends TestCase
{
  public function setUp()
  {
      parent::setUp();
      create('App\Role', ['name'=>'teacher']);
  }
    /** @test */
    public function an_authenticated_teacher_can_create_course()
    {
      // given an authenticated teacher and a course
      $teacher = create('App\User');
      $teacher->assignRole('teacher');
      $this->signIn($teacher);
      $course = make('App\Course');

      // when hitting endpoint to create a course
      $this->post('/courses', $course->toArray());

      // then, when we visit all courses  
      $this->get('/courses')->assertSee($course->title);
      $this->get('/courses/'.$course->id)
            ->assertSee($course->title)
            ->assertSee($teacher->last_name);
    }
}
