<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;

    public $user_details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $title, $user_details)
    {
        $this->title = $title;
        $this->user_details = $user_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {  // customer_mail is the name of template
        return $this->subject($this->title)->view('user_mail');
    }
}
