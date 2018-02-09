<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitUserTest extends TestCase
{

  public function setUp()
  {
      parent::setUp();
      $this->user = create('App\User');
      create('App\Role', ['name'=>'member']);
      create('App\Role', ['name'=>'manager']);
      create('App\Role', ['name'=>'email_confirmed']);
  }

  /** @test */
  public function a_user_can_have_roles()
  {
    $this->user->assignRole('manager');
    $this->user->assignRole('member');
    $this->assertTrue($this->user->hasRole(\App\Role::find([1,2])));
    $role_1 = $this->user->revokeRole('manager');
    $role_2 = $this->user->revokeRole('member');
    $this->assertEquals(1, $role_1);
    $this->assertEquals(1, $role_2);
    $this->assertEquals($this->user->roles()->count(),0);
  }

  /** @test */
  public function a_user_can_revoke_roles()
  {
    $this->user->assignRole('manager');
    $role_1 = $this->user->revokeRole('manager');
    $this->assertEquals($this->user->roles()->count(),0);
  }

  /** @test */
  public function a_user_can_participate_in_one_course()
  {
    $p = create('App\Participant', ['user_id'=>$this->user->id]);
    $c = \App\Course::find($p->course_id);
    $this->assertEquals($this->user->participates->first()->id, $c->id);
  }

  /** @test */
  public function a_user_can_participate_in_multiple_courses()
  {
    $c1 = create('App\Course');
    $c2 = create('App\Course');
    $c3 = create('App\Course');
    $p1 = create('App\Participant', [
      'course_id' => $c1->id,
      'user_id' => $this->user->id,
    ]);
    $p2 = create('App\Participant', [
      'course_id' => $c2->id,
      'user_id' => $this->user->id,
    ]);
    $p3 = create('App\Participant', [
      'course_id' => $c3->id,
      'user_id' => $this->user->id,
    ]);
    $this->assertEquals(3, $this->user->participates->count());
  }

  /** @test */
  public function a_user_can_verify_email()
  {
    $this->assertTrue($this->user->email_verification_token!=null);
    $this->user->verifyEmail();
    $this->assertTrue($this->user->email_verification_token==null);
    $this->assertTrue($this->user->hasRole('email_confirmed'));
  }

  /** @test */
  public function a_user_has_a_route_for_verification()
  {
    $s1 = config('app.url').'verify_email/'.$this->user->email_verification_token;
    $s2 = $this->user->getEmailVerificationUrl();
    $this->assertEquals($s1, $s2);
  }

  /** @test */
  public function a_user_has_a_profile()
  {
    $this->assertInstanceOf('App\Profile',$this->user->profile);
    $this->user->profile->city = 'Nuremberg';
    $this->user->profile->save();
    $this->assertEquals('Nuremberg',$this->user->profile->city);
  }

  // TODO: $this->user->hasPermission(Permission $permission)

}
