<?php

namespace App\Http\Controllers;

use App\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactUsController extends Controller
{
    public function contacts()
    {
        $contacts = ContactUs::simplePaginate(3);
        return view('admin.contactUs.index', compact('contacts'));
    }

    public function createContact()
    {
        return view('contactUs.create');
    }

    public function saveContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required | email',
            'phone' => 'required | numeric',
            'message' => 'required',
        ]);

        $contact = new ContactUs();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->save();

        return Redirect::back()->with('successMsg', 'Thanks for contacting us, we will get back to you shortly !!!');

    }

}
