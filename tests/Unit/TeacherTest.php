<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeacherTest extends TestCase
{

    /** @test */
    public function a_teacher_has_courses()
    {
      $course = create('App\Course');
      $teacher = \App\Teacher::find($course->teacher_id)->first();
      $this->assertInstanceOf('App\Teacher',$course->teacher()->first());
      $this->assertEquals($teacher->courses->first()->title, $course->title);
    }

    /** @test */
    public function a_teacher_has_a_profile()
    {
      $teacher = create('App\Teacher');
      $this->assertInstanceOf('App\Profile',$teacher->profile);
      $teacher->profile->city = 'Nuremberg';
      $teacher->profile->save();
      $this->assertEquals('Nuremberg',$teacher->profile->city);
    }

    /** @test */
    public function a_teacher_can_have_many_courses()
    {
      $teacher = create('App\Teacher');
      $courses = factory('App\Course', 3)->create(['teacher_id'=>$teacher->id]);
      $this->assertEquals($teacher->courses->count(), 3);
    }

    /** @test */
    public function a_teacher_has_participants()
    {
      $teacher = create('App\Teacher');
      $course = create('App\Course', ['teacher_id'=>$teacher->id]);
      $participants = factory('App\Participant', 3)->create(['course_id'=>$course->id]);
      $this->assertEquals(3, $teacher->participants->count());
    }

    /** @test */
    public function a_teacher_has_participants_from_different_courses()
    {
      $teacher = create('App\Teacher');
      $course_1 = create('App\Course', ['teacher_id'=>$teacher->id]);
      $participant_1 = create('App\Participant',['course_id'=>$course_1->id]);
      $course_2 = create('App\Course', ['teacher_id'=>$teacher->id]);
      $participant_2 = create('App\Participant',['course_id'=>$course_2->id]);
      $course_3 = create('App\Course', ['teacher_id'=>$teacher->id]);
      $participant_3 = create('App\Participant',['course_id'=>$course_3->id]);
      $this->assertEquals(3, $teacher->participants->count());
    }
}
