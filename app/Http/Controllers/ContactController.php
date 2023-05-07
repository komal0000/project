<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if($request->getMethod()=="POST"){
            $contact = new Contact();
            $contact->email = $request->email;
            $contact->name = $request->name;
            $contact->subject =$request->subject;
            $contact->message =$request->message;
            $contact->save();
            return redirect()->back();
        }
        else{
            return view('front.pages.contact');
        }
    }
}
