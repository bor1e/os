<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseUTest extends TestCase
{
  use DatabaseMigrations;

  public function setUp()
  {
      parent::setUp();
      $this->course = factory('App\Course')->create();
      $this->user = factory('App\User')->create();
  }

  /** @test */
  public function a_course_can_add_participants()
  {
    $this->course->addParticipant([
      'course_id' => $this->course->id,
      'user_id' => $this->user->id,
    ]);

    $this->assertCount(1, $this->course->users());
  }



}
