<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailConfirmation extends TestCase
{
    /** @test */
    public function testEmail()
    {
        //$this->assertTrue(false);
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
