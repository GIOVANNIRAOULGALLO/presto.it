<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function create(){
        return view('mail.create');
    }
    public function sendMail(Request $req){
        $user=Auth::user()->name;
        $useremail=Auth::user()->email;
        $contact = compact($req,'user','useremail');
        Mail::to($useremail)->send(new ContactMail($contact));
        return redirect(route('homepage'))->with('message','Sarai contattato al piu presto');
    }
}
