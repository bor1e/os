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

    public $user;
    #public $connection = 'emails';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        #echo 'HERE WE construct: '. now() . " \t\n";
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        #echo 'Queue-Class:'. $this->job->resolveName()."\t\n";
        #dd($this->job->getConnectionName());
        echo 'Queue-Class:'. $this->job->getConnectionName()."\t\n";
        echo 'User:'. $this->user->first_name."\t\n";
        echo 'Job Id:'. var_dump($this->job->payload()) ."\t\n";
        echo 'Email being sent '. now()."\t\n";
        if(!$this->user->participates()->count())
            return;
        // TODO: only active courses!
        Mail::to($this->user->email)
            ->send(new EnrollmentMail($this->user));
    }
}
