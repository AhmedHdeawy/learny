<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCode extends Mailable
{
    use Queueable, SerializesModels;

    public $phone;
    public $code;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($phone, $code, $password)
    {
        $this->phone = $phone;
        $this->code = $code;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.sendCode');
    }
}
