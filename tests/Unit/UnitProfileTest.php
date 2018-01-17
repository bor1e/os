<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitProfileTest extends TestCase
{
  /** @test */
  public function a_profile_belongs_to_a_teacher()
  {
    $teacher = create('App\Teacher');
    $profile = \App\Profile::find($teacher->profile_id);
    $this->assertEquals($teacher->id, $profile->owner->first()->id);
    $this->assertInstanceOf('App\Teacher',$profile->owner->first());
  }

  /** @test */
  public function a_profile_belongs_to_a_user()
  {
    $user = create('App\User');
    $profile = \App\Profile::find($user->profile_id);
    $this->assertEquals($user->id, $profile->owner->first()->id);
    $this->assertInstanceOf('App\User',$profile->owner->first());
  }
}
