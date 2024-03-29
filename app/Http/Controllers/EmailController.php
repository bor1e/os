<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class EmailController extends Controller
{

  public function verify($token)
  {
      $user = User::whereEmailVerificationToken($token)->first();

      if (is_null($user)) {
          return redirect('/courses')
                  ->with('message', 'The email confirmation \
                              link you followed has expired.');
      }

      $user->verifyEmail();

      return redirect('/courses')->with('message', 'Your account is now verified.');
  }
}
