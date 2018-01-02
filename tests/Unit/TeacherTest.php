<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeacherTest extends TestCase
{
  use DatabaseMigrations;

    /** @test */
    public function course_teacher_id_instance_of_teacher()
    {
      $teacher = factory('App\Teacher')->create();
      $course = \App\Course::find($teacher->course_id);
      $this->AssertInstanceOf('App\Teacher', $course->owner()->first());
    }

    /** @test */
    public function course_teacher_instance_of_user()
    {
      $teacher = factory('App\Teacher')->create();
      $course = \App\Course::find($teacher->course_id);
      $this->AssertInstanceOf('App\User', $course->teacher());
    }

    /** @test */
    public function teacher_has_courses()
    {
      $course = create('App\Course');
      $teacher = create('App\Teacher', ['course_id'=>$course->id]);
      $this->assertTrue($teacher->courses->contains($course));
    }

    /** @test */
    public function teacher_has_a_user()
    {
      $user = create('App\User');
      $teacher = create('App\Teacher', ['user_id'=>$user->id]);
      $this->assertEquals($teacher->user->first()->last_name, $user->last_name);
    }

    /** @test */
    public function a_course_has_an_owner()
    {
      $course = create('App\Course');
      $teacher = create('App\Teacher', ['course_id'=>$course->id]);
      $this->assertEquals($course->owner->first()->last_name, $teacher->last_name);
    }

    /** @test */
    public function a_course_has_a_teacher()
    {
      $course = create('App\Course');
      $teacher = create('App\Teacher', ['course_id'=>$course->id]);
      $this->assertInstanceOf('App\User',$course->teacher());
      $this->assertEquals($course->teacher()->last_name, $teacher->user->first()->last_name);
    }
}
