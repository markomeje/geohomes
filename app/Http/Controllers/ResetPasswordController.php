<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use Hash;
use Sentinel;
use Mail;

class ResetPasswordController extends Controller
{

    public function admin()
    {
        return view('reset_password');
    }

 
    public function passwordreset(Request $request){
        $user =User::whereEmail($request->email)->first();

        if ($user == null) {
            return redirect()->back()->with(['error'=>'Sorry, the Email Address does not exist.']);
        }

        $user=Sentinel::findById($user->id);
        $reminder=User::exists($user) ? : User::create($user);
        $this->sendEmail($user,$reminder);

        return redirect()->back()->with(['success' => 'The Reset link has been sent to your email. Thank you.']);
        
      
    }
    Public function sendEmail($user, $code){
        Mail::send(
            'forgot ',
            ['user'=>$user, 'code'=> $code],
            function($message) use ($user){
                $message->to($user->email);
                $message->subject("$user->email, reset your password.");
            });

    }
}
