<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseUTest extends TestCase
{
  use DatabaseMigrations, \MailTracking;

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

  /** @test */
  public function testEmail()
  {
    $email = 'johndoe@gmail.com';

   $response = $this->post('/register', [
       'first_name' => 'John',
       'last_name' => 'Doe',
       'email' => $email,
       'password' => 'secret',
       'password_confirmation' => 'secret'
   ]);

   $this->seeEmailWasSent();
  }

}
