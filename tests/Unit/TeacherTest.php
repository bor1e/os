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
}
