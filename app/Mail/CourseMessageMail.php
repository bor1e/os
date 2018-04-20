<?php

namespace App\Mail;

use App\Course;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CourseMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $course;
    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Course $course, $message)
    {
        $this->course = $course;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Information zu: {$this->course->title}")
              ->markdown('emails.course_message')
              ->with('message', $this->message);
    }
}
