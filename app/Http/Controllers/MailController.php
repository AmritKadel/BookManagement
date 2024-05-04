<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactUsForm;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendContactForm(Request $request)
{
    
    $request->validate([
        'username' => 'required',
        'email' => 'required',
        'message' => 'required',
        

    ]);
    
    $username = $request->input('username');
    $email = $request->input('email');
    $subject = $request->input('message');
    $contact_number = $request->input('contact_number');
    $school_name = $request->input('school_name');
    

    $data = [
        'username' => $username,
        'email' => $email,
        'subject' => $subject,
        'contact_number' => $contact_number,
        'school_name' => $school_name
    ];

    Mail::send('frontend.emailtemplate.contactemail', $data, function ($message) use ($data) {
        $message->to($data['email']);
        $message->from(env('MAIL_USERNAME'));
        $message->subject('From the Contact Page');
    });

    $userData = new ContactUsForm();
    $userData->name = $username;
    $userData->email = $email;
    $userData->message = $subject;
    $userData->phone_number = $contact_number;
    $userData->school_name = $school_name;
    $userData->status = 0;
    $userData->save();
    return redirect()->back()->with('message', 'Your message has been sent successfully!');
}
}