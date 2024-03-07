<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ContactController;

class ContactController extends Controller
{
      //contact page for user
    public function contactPage(){
        return view('user.contact.contact');
    }

    //contact form submit for user
    public function contactSend(Request $request){
        $this->validationCheck($request);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        Contact::create($data);
        return back()->with(['success'=>'Your message has sent successfully']);

    }

    //message validation check
    private function validationCheck($request){
        $validationRules = [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required | min:10 | max:255'
        ];

        Validator::make($request->all(), $validationRules)->validate();
    }

    //admin side
    //contact list for admin
    public function contactList(){
        $contactData = Contact::orderBy('created_at','desc')
         ->paginate(4);
        $contactData->appends(request()->all());

        $unreadMessage = Contact::where('status',0)->get();

        return view('admin.user.contact', compact('contactData','unreadMessage'));
    }



}
