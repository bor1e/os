<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    /** @test */
    public function a_user_can_edit_the_user_model()
    {
      $user = create('App\User');
      $this->signIn($user);
      $this->get('/profile')
          ->assertSee('Edit Profile')
          ->assertSee($user->last_name);
    }

    /** @test */
    public function a_user_can_edit_the_associated_profile_of_user()
    {
      $user = create('App\User');
      $this->signIn($user);
      $quote = 'This is awesome!';
      $user->profile->quotes = $quote;
      $this->post('/profile', array_merge($user->toArray(), $user->profile->toArray()));
      $this->get('/profile')
          ->assertSee($quote);
    }
}
