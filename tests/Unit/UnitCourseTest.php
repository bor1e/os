<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitCourseTest extends TestCase
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

    $this->assertCount(1, $this->course->users);
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

  /** @test */
  public function a_course_has_participants()
  {
    factory('App\Participant',5)->create(['course_id'=>$this->course->id]);
    $this->assertInstanceOf('App\Participant', $this->course->participants->first());
    $this->assertEquals(5, $this->course->participants->count());
  }

  /** @test */
  public function a_course_has_users()
  {
    factory('App\Participant',5)->create(['course_id'=>$this->course->id]);
    $this->assertInstanceOf('App\User', $this->course->users->first());
    $this->assertEquals(5, $this->course->users->count());
  }

  /** @test */
  public function a_course_belongsTo_a_teacher()
  {
    $this->assertInstanceOf('App\Teacher', $this->course->teacher);
  }

  /** @test */
  public function a_course_has_a_teacher()
  {
    $this->assertEquals(1,$this->course->hasTeacher());
  }


}
