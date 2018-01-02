<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseUTest extends TestCase
{

  public function setUp()
  {
      parent::setUp();
      $this->course = create('App\Course');
      $this->user = create('App\User');
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

  /** @test */
  public function a_course_belongsTo_a_channel()
  {
    $this->assertInstanceOf('App\Channel', $this->course->channel);
  }

  /** @test */
  public function a_course_has_a_string_path()
  {
    $this->assertEquals('/courses/'.$this->course->channel->name. '/'. $this->course->id ,$this->course->path() );
  }

}
