<?php

namespace App\Http\Controllers;

use App\Traits\EmailSentTraits;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use EmailSentTraits;

    public function contact(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:191',
            'email'=>'required|email',
            'subject'=>'required|string|max:191',
            'message'=>'required',
        ]);
        $message = '<p>Message Form Contact Us</p>'."<span>Name : ".$request->name."</span> <br>"."<span> Email : ".$request->email."</span> <br>"
            ."<span> Subject : ".$request->subject."</span> <br>"."<p> Message : ".$request->message."</p>";
        $this->simpleEmail($request->subject,"Admin",env('ADMIN_NOTIFY_MAIL'),$message);
        return redirect()->back()->with('success-alert2', 'Thank you for contacting with us.');
    }
}
