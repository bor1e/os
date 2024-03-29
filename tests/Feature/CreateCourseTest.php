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
    public function an_authenticated_member_cannot_create_course()
    {
      $member = create('App\User');
      $member->assignRole('member');
      $this->signIn($member);
      $course = make('App\Course');
      $this->post('/courses', $course->toArray())->assertStatus(403);
      $this->get('/courses')->assertDontSee($course->title);
    }

    /** @test */
    public function a_manager_can_edit_a_course()
    {
      #$manager = $this->createUserWithPermissionTo('update');
      $manager = create('App\User');
      $manager->assignRole('manager');
      $this->withoutExceptionHandling()->signIn($manager);
      $course = create('App\Course', [
        'status'=>'pending',
    #    'date' => '18.01.2019',
    #    'time' => '19:20',
      ]);
      $this->get($course->path())->assertSee($course->title);
      $this->get($course->path().'/edit')->assertSee($course->date->format('d.m.Y'));
      $course->title = 'New Title '. \Carbon\Carbon::today()->toDateTimeString();
      $this->put($course->path() . '/edit', array_merge($course->toArray(), ['date'=>'12.03.2019']))
        ->assertRedirect($course->path());
        #dd(session('errors'));
        $this->get($course->path())
        //->assertDontSee($course->title)
        ->assertSee('New Title '. \Carbon\Carbon::today()->toDateTimeString());
    }

    /** @test */
    public function a_date_is_displayesd()
    {
        $course = create('App\Course');
        $this->get($course->path())->assertSee($course->date->format('d.m'));
    }

    // TODO: teacher <-> user relation, user cannot create but update class
    /* * @test * /
    public function a_teacher_who_is_class_owner_can_edit_class()
    {
      // a manager can edit an exisiting course
      $user = $this->createUserWithPermissionTo('update');
      $user->assignRole('teacher');
      $this->withoutExceptionHandling()->signIn($user);
      $course = \App\Course::find($teacher->course_id);
      $course->title = 'New Title '. \Carbon\Carbon::today()->toDateTimeString();
      $this->post($course->path() . '/edit', $course->toArray());
      $this->get($course->path())
        ->assertSee('New Title '. \Carbon\Carbon::today()->toDateTimeString());
    }*/

    /** @test */
    public function a_course_needs_to_have_a_title()
    {
        $user = create('App\User');
        $user->assignRole('manager');
        $this->withExceptionHandling()->signIn($user);
        $course = make('App\Course', ['title'=>null]);
        $this->post('/courses', $course->toArray())
          ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_course_needs_to_have_all_data_when_published()
    {
        $user = create('App\User');
        $user->assignRole('manager');
        $this->withExceptionHandling()->signIn($user);
        $overrides = [
            'status'=>'published',
            'date' => today(),#->addDays(1),
            'time' => '19',
            'body' => null,
            'slug' => null,
            'g2m_id' => '121321312312',
            'intervall' => null,
            'meetings' => null,
            'teacher_id' => null,
        ];
        $course = make('App\Course', $overrides);
        $errors = ['date','time','body','slug','g2m_id', 'intervall', 'meetings', 'teacher_id'];
        $this->post('/courses', $course->toArray())
          ->assertSessionHasErrors($errors);
    }
}
