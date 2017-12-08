<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
  use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testExample()
    {
        $user = factory(User::class)->create([
          'email' => 'eli@gmail.com',
        ]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/home');
        });
    }
}
