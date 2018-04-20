<?php

namespace App\Listeners;

use App\Events\StatusChange;
use App\Mail\StatusChangeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendStatusChangeEmail implements ShouldQueue
{
    use InteractsWithQueue;
    public $connection = 'emails';
    #public $queue = 'emails';
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
        echo 'User: ' . $event->user->last_name."\n";
        echo 'Queued Job Id:'. $this->job->getJobId()."\n";
        echo 'Queue-Name:'. $this->job->getQueue()."\n";
        echo 'Queue-Class:'. $this->job->resolveName()."\n";
        #echo 'Queue-Connection:'. $this->job->getConnection()."\n";
        #echo 'Queued Job RawBody:'. $this->job->getRawBody()."\n";
        Mail::to($event->user->email)->send(new StatusChangeMail($event->user));#->onConnection('redis')->onQueue('emails');
    }
}
