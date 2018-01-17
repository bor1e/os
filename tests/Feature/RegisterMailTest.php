<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Events\UserHasRegistered;
use App\Mail\UserHasRegisteredMail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterMailTest extends TestCase
{

    /** @test */
    public function an_UserHasRegistered_event_was_triggered()
    {
      // TODO: change user controller according to new table
      Event::fake();
      $user = make('App\User');
      $data = $user->toArray();
      $data['password'] = $user->password;
      $data['password_confirmation'] = $user->password;
      $response = $this->withoutExceptionHandling()->post('/register', $data);
      Event::assertDispatched(UserHasRegistered::class, function ($event) use ($user) {
         return $event->user->email === $user->email;
     });
    }

    /** @test */
    public function an_email_is_sent_to_freshly_registered_user()
    {
      Mail::fake();
      $user = make('App\User');
      $data = $user->toArray();
      $data['password'] = $user->password;
      $data['password_confirmation'] = $user->password;
      $this->assertDatabaseMissing('users', [
       'email' => $user->email,
      ]);
      $response = $this->post('/register', $data);

      Mail::assertSent(UserHasRegisteredMail::class, function ($mail) use ($user) {
             return $mail->hasTo($user->email);
           });
    }

    /** @test */
    public function a_user_can_verify_email()
    {
      $user = create('App\User');
      create('App\Role', ['name'=>'email_confirmed']);
      $this->withoutExceptionHandling()
        ->get(route('verify_email', ['token' => $user->email_verification_token]))
        ->assertRedirect('/courses');
      $this->assertNull($user->fresh()->email_verification_token);

    }
}
