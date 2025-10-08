<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotificationMail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $to = "zuppiepurnea@gmail.com";
        $msg = "yjxktwnmkuytwdmp";
        $subject = "Test Mail";
        Mail::to($to)->send(new LoginNotificationMail($msg, $subject));
    } 
}
