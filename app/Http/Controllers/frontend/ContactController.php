<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewContact;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact-us.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|',
            'subject' => 'required|min:8',
            'message' => 'required|min:8',
        ];
        $customMessages = [
            'name.required' => 'The name field must be at least 3 characters and required.',
            'email.required' => 'The email field must be at right format and required.',
            'phone.required' => 'The phone field must be filled.',
            'subject.required' => 'The subject field must be at least 8 characters and required.',
            'message.required' => 'The message field must be at least 8 characters and required.',
        ];
        $this->validate($request, $rules, $customMessages);
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        $this->newContact();
        return redirect()->back()->with('success', 'Your Message Sent Successfully!');
    }

    public function newContact()
    {
        $users = User::get();
        foreach ($users as $user) {
            if ($user->hasAnyRole('super-admin', 'admin')) {
                $user->notify(new NewContact('The New Contact have a message'));
            }
        }
    }
}
