<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnrollmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    #public $connection = 'emails';

     /**
      * Create a new message instance.
      *
      * @return void
      */
     public function __construct(User $user)
     {
         $this->user = $user;
     }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Deine OnlineShiurim ...")
              ->markdown('emails.enrollment');
    }
}
