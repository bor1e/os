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
      create('App\Role', ['name'=>'member']);
      create('App\Role', ['name'=>'manager']);

  }
    /** @test */
    public function an_authenticated_teacher_can_create_course()
    {
      // given an authenticated teacher and a course
      $teacher = create('App\User');
      $teacher->assignRole('teacher');
      //$this->signIn($teacher);
      $this->be($teacher);
      $course = make('App\Course', ['datetimetz'=>'08.01.2018 18:30']);

      // when hitting endpoint to create a course
      $res = $this->post('/courses', $course->toArray());

      /*create('App\Teacher', [
        'user_id'=>$teacher->id,
        'course_id'=>\App\Course::where('title','=',$course->title)->first()->id,
      ]);
      */
      // then, when we visit all courses
      $this->get('/courses')->assertSee($course->title);
      $this->get($course->path())
            ->assertSee($course->title)
            ->assertSee($teacher->last_name);
    }

    /** @test */
    public function an_authenticated_member_cannot_create_course()
    {
      // given an authenticated teacher and a course
      $member = create('App\User');
      $member->assignRole('member');
      $this->signIn($member);
      $course = make('App\Course', ['datetimetz'=>'08.01.2018 18:30']);

      // when hitting endpoint to create a course
      //$this->expectException('Illuminate\Auth\AuthenticationException');
      $this->post('/courses', $course->toArray())->assertStatus(403);
      $this->get('/courses')->assertDontSee($course->title);
    }

    /** @test */
    public function a_manager_can_edit_a_course()
    {
      // a manager can edit an exisiting course
      $manager = $this->createUserWithPermissionTo('manageUsers');
      $manager->assignRole('manager');
      $this->signIn($manager);
      #$this->be($manager);
      $course = create('App\Course');
      $this->get($course->path())->assertSee($course->title);
      $course->title = 'New Title '. \Carbon\Carbon::today()->toDateTimeString();
      $this->post($course->path() . '/edit', $course->toArray())
        ->assertRedirect($course->path());
      $this->get($course->path())
        //->assertDontSee($course->title)
        ->assertSee('New Title '. \Carbon\Carbon::today()->toDateTimeString());
    }

    /** @test */
    public function a_teacher_who_is_class_owner_can_edit_class()
    {
      // a manager can edit an exisiting course
      $user = $this->createUserWithPermissionTo('update');
      $user->assignRole('teacher');
      $this->signIn($user);
      $teacher = create('App\Teacher', ['user_id'=>$user->id]);
      $course = \App\Course::find($teacher->course_id)->first();
      $course->title = 'New Title '. \Carbon\Carbon::today()->toDateTimeString();
      $this->post($course->path() . '/edit', $course->toArray());
      $this->get($course->path())
        ->assertSee('New Title '. \Carbon\Carbon::today()->toDateTimeString());
    }


}
