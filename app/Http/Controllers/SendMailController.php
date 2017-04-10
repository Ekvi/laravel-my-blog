<?php

namespace App\Http\Controllers;


use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function sendMail()
    {
        $userId = 1;

        Mail::to('dima_sh84@mail.ru')->send(new TestMail($userId));
    }
}