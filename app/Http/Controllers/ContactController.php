<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required','string','max:100'],
            'last_name' => ['required','string','max:100'],
            'email' => ['required','email','max:255'],
            'subject' => ['required','string','max:200'],
            'message' => ['required','string','max:5000'],
        ]);

        try {
            Mail::send('emails.contact', ['data' => $data], function ($message) use ($data) {
                $message->to('abhijitscom@gmail.com')
                    ->subject('KOS Digital: '.$data['subject'])
                    ->replyTo($data['email']);
            });
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'Some error occurred while sending your message. Please try again.');
        }

        return back()->with('success', 'Your message successfully sent.');
    }
}
