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
        $this->post('/shomer/teacher/create', $teacher->toArray())
            ->assertRedirect($path);
        $this->assertDatabaseHas('teachers', ['last_name'=>$teacher->last_name]);
        $this->get($path)
            ->assertSee($teacher->last_name);
    }
}
