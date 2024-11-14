<?php

namespace Exiliensoft\Contact\Http\Controllers;
use App\Http\Controllers\Controller;
use Exiliensoft\Contact\Mail\ContactMailable;
use Exiliensoft\Contact\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    
    public function index()
    {
        return view('contact::contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
    
        try {
            $recipientEmail = $request->input('email');
    
            Mail::to($recipientEmail)->send(new ContactMailable($request->only(['name', 'email', 'message'])));
    
            Contact::create($request->only(['name', 'email', 'message']));
    
            return redirect()->route('contact.index')->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error sending your message. Please try again.');
        }
    }
    
}
