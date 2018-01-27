<?php

namespace App\Listeners;

use App\Events\UserHasRegistered;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserHasRegisteredMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationEmail implements ShouldQueue
{
    use InteractsWithQueue;
    public $connection = 'emails';
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
        echo 'User: ' . $event->user->last_name."\n";
        echo 'Queued Job Id:'. $this->job->getJobId()."\n";
        echo 'Queue-Name:'. $this->job->getQueue()."\n";
        Mail::to($event->user->email)->send(new UserHasRegisteredMail($event->user));
    }
}
