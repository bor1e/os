<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeacherProfileTest extends TestCase
{
    /** @test */
    public function a_manager_can_create_a_teacher()
    {
        $this->withoutExceptionHandling();
        create('App\Role', ['name'=>'manager']);
        $user = $this->createUserWithPermissionTo('manageUsers');
        $this->signIn($user);
        $teacher = make('App\Teacher');
        $path = '/teacher/'.strtolower(now()->format('oz'). '-' . $teacher->first_name . '-' . $teacher->last_name);
        $this->post('/shomer/teacher', $teacher->toArray())
            ->assertRedirect($path);
        $this->assertDatabaseHas('teachers', ['last_name'=>$teacher->last_name]);
        $this->get($path)
            ->assertSee($teacher->last_name);
    }

    /** @test */
    public function a_validation_error_still_displays_input_data()
    {
        #$this->withoutExceptionHandling();
        create('App\Role', ['name'=>'manager']);
        $user = $this->createUserWithPermissionTo('manageUsers');
        $this->signIn($user);
        $teacher = make('App\Teacher');
        $teacher->email = null;
        $this->get('/shomer/teacher');
        $this->post('/shomer/teacher',array_merge($teacher->toArray(),$teacher->profile->toArray(), ['birthday'=>'27.08.1990']))
         ->assertSessionHasErrors('email');
         #->assertSee('27.08.1990');
    }

    /** @test */
    public function a_manager_can_edit_a_teacher()
    {
        $this->withoutExceptionHandling();
        create('App\Role', ['name'=>'manager']);
        $user = $this->createUserWithPermissionTo('manageUsers');
        $this->signIn($user);
        $teacher = create('App\Teacher');
        $note = 'New Note '.now();
        $this->get('/shomer'.$teacher->path().'/edit')
            ->assertSee($teacher->last_name)
            ->assertSee($teacher->profile->birthday->format('d.m.Y'));
        $teacher->profile->notes = $note;
        #$birthday = ['birthday'=>'27.08.1990'];
        #dd(array_merge($teacher->toArray(), $birthday));
        $this->put('/shomer'.$teacher->path().'/edit',array_merge($teacher->toArray(),$teacher->profile->toArray(), ['birthday'=>'27.08.1990']));
        #$this->put('/shomer'.$teacher->path().'/edit', $teacher->toArray());

        $this->get($teacher->path())
            ->assertSee($note);
    }

    /** @test */
    public function a_manager_can_see_all_teachers()
    {
        $this->withoutExceptionHandling();
        create('App\Role', ['name'=>'manager']);
        $user = $this->createUserWithPermissionTo('manageUsers');
        $this->signIn($user);
        $teacher = create('App\Teacher');
        $this->get('/shomer/teachers')
            ->assertSee($teacher->last_name);
    }
}
