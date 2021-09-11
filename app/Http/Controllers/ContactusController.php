<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Response;
use Mail;
use App\Models\Contactus;

class ContactusController extends Controller
{
    function index()
    {
     return view('welcome');
    }

    function submit(Request $request)
    {
     $data = array(
      'name_data'  => $request->name,
      'email_data' => $request->email,
      'message_data' => $request->message
     );

     Mail::send('mail', $data, function($message) use ($request){
      $message->to(env('MAIL_USERNAME'), 'TASTECHNICAL')->subject('New Enquiry received ' . $request->name);
      $message->from($request->email, $request->name);
     });

     Contactus::create($request->all());

     return redirect()->back()->with('success', 'Message has been sent...');
    }
}
?>