<?php

namespace App\Jobs;

use App\Course;
use App\Mail\ReminderMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CourseReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $course;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo 'Queue-Class:'. $this->job->getConnectionName()."\t\n";

        if($this->course->users()->count() > 0) {
            $users = $this->course->users()->get();

            foreach($users as $i => $user) {
                echo $i . " User: " . $user->email. "\n";
                Mail::to($user->email)
                    ->send(new ReminderMail($this->course));
                echo 'Email sent '. now()."\t\n";
            }
        #    dd('test');
        } else {
            echo 'Course '. $this->course->title." HAS NO USERS\t\n";
        }
    }
}
