<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StatusChangeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
    *  The \App\User instance
    *
    *  @var \App\User
    */
   public $user;

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
        return $this->subject("OnlineShiurim - {$this->user->first_name} los gehts!")
              ->markdown('emails.status_change');
    }
}
