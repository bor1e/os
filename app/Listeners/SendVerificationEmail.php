<?php

namespace App\Listeners;

use App\Events\UserHasRegistered;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserHasRegisteredMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserHasRegistered  $event
     * @return void
     */
    public function handle(UserHasRegistered $event)
    {
      Mail::to($event->user->email)->send(new UserHasRegisteredMail($event->user));
    }
}
