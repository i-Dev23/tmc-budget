<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailNew extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $getNameDivForSubject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $getNameDivForSubject)
    {
        //
        $this->details = $details;
        $this->getNameDivForSubject = $getNameDivForSubject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        \Log::info("this is budhet");
        return $this->subject($this->getNameDivForSubject)->view('email.myemail');
        // return $this->view('email.myemail');
    }
}
