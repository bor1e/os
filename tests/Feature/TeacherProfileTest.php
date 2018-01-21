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
    public function a_manager_can_edit_a_teacher()
    {
        $this->withoutExceptionHandling();
        create('App\Role', ['name'=>'manager']);
        $user = $this->createUserWithPermissionTo('manageUsers');
        $this->signIn($user);
        $teacher = create('App\Teacher');
        $note = 'New Note '.now();
        $this->get('/shomer'.$teacher->path().'/edit')
            ->assertSee($teacher->last_name);
        $teacher->notes = $note;
        $this->put('/shomer'.$teacher->path().'/edit', $teacher->toArray());
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
