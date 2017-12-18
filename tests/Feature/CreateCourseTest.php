<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCourseTest extends TestCase
{
  use DatabaseMigrations;
    /** @test */
    public function an_authenticated_teacher_can_create_course()
    {
      // given an authenticated teacher

      // when hitting endpoint to create a course


      // then, when we visit all courses

      // we should see the new course
      /*
      $this->get('/courses')
          ->assertSee($course->title)
          ->assertSee($course->body)
          ->assertSee($teacher->user()->last_name);
      */
      $this->assertTrue(true);
    }
}
