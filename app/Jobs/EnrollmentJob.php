<?php

namespace App\Jobs;

use App\User;
use App\Mail\EnrollmentMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EnrollmentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    #public $connection = 'emails';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo 'User: ' . $event->user->last_name."\n";
        echo 'Queued Job Id:'. $this->job->getJobId()."\n";
        echo 'Queue-Name:'. $this->job->getQueue()."\n";
        
        if(!$this->user->participates()->count())
            return;

        Mail::to($this->user->email)
            ->send(new EnrollmentMail($this->user));
    }
}
