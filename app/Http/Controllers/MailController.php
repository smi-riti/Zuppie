<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotificationMail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $to = "pujakumari11th2003@gmail.com";
        $msg = "dummy vbnnhbhgygg";
        $subject = "Test Mail";
        Mail::to($to)->send(new LoginNotificationMail($msg, $subject));
    }

    // function sendLoginNotification(Request $request)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'email' => 'required|email',
    //         'name' => 'required|string|max:255',
    //     ]);

    //     // Create a new instance of the LoginNotificationMail
    //     $mail = new \App\Mail\LoginNotificationMail($request->user());

    //     // Send the email
    //     \Illuminate\Support\Facades\Mail::to($request->email)->send($mail);

    //     return response()->json(['message' => 'Login notification sent successfully.']);
    // }   
}
