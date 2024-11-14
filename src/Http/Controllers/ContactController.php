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
        Mail::to('mohit@exiliensoft.com')->send(new ContactMailable($request));
        Contact::create($request->all());
        return redirect(route('index'));
    }
}
