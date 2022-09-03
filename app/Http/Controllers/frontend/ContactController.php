<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Str;


class ContactController extends Controller
{
     public function index()
    {
        return view('frontend.contact');
    }

    /* submission of form */
    public function ContactInsert(Request $request){


$data = request()->all();
        $validator = Validator::make($data, [
             'name' => ['required'], 
            'email' => ['required', 'email'], 
            'message' => ['required'], 
           
        ]);

          if ($validator->fails()) {
         return back()
         ->withInput()
         ->withErrors($validator);
        }

        else{

        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');
        $data=array(
            'name'=>$name,
            'email'=>$email,
            'message'=>$message,
        );
            $submit= DB::table('contacts')->insert($data);

        if ($submit) {
            return back()->with('success', 'Your Message has been submitted. Thank You.');

    }

       else{
        return back()->with('error', 'message not sent. Please try Again.');
       }
    }
  }
}
