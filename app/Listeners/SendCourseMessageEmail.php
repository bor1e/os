<?php

namespace App\Listeners;

use App\Events\CourseMessage;
use App\Mail\CourseMessageMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCourseMessageEmail implements ShouldQueue
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
     * @param  CourseMessage  $event
     * @return void
     */
    public function handle(CourseMessage $event)
    {
        if($event->course->users()->count() > 0) {
            $users = $event->course->users()->get();

            foreach($users as $i => $user) {
                echo $i . " User: " . $user->email. "\n";
                Mail::to($user->email)
                    ->send(new CourseMessageMail($event->course, $event->message));
                echo 'Email sent '. now()."\t\n";
            }
        #    dd('test');
        } else {
            echo 'Course '. $event->course->title." HAS NO USERS\t\n";
        }
        
    }
}
