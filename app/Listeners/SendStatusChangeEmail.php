<?php

namespace App\Listeners;

use App\Events\StatusChange;
use App\Mail\StatusChangeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendStatusChangeEmail implements ShouldQueue
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
     * @param  StatusChange  $event
     * @return void
     */
    public function handle(StatusChange $event)
    {
        Mail::to($event->user->email)->send(new StatusChangeMail($event->user));
    }
}
