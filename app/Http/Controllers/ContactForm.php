<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;

class ContactForm extends Controller
{
    public function send(ContactFormRequest $request)
    {
      $request->sendMail();

      return redirect('/')->with('status', 'Thank you for contacting us, your
        message is being processed.');
    }
}
