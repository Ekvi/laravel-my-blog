<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $age = 32;
    public $userId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'dmitrii.shribak@gmail.com';
        $name = 'Dmitrii';
        $subject = 'Test sending mails';

        $user = User::where('id', $this->userId)->first();

        return $this->view('emails.mail')
            ->from($address, $name)
            ->subject($subject)->with('name', $user->name);
    }
}
