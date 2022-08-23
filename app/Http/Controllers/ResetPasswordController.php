<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Mail;



class ResetPasswordController extends Controller
{

    public function admin()
    {
        return view('password.reset_password_link');
    }



    public function Resetpasswordlink(Request $request)
    {

        //You can add validation login here
        $user = DB::table('users')->where('email', '=', $request->email)
            ->first();
            if($user == null){
                return redirect(route('resetpassword'))->with('error', "Sorry, your email is not valid.");
            }
        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => str::random(60),
            'created_at' => Carbon::now()
        ]);

        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();
        
        if ($this->sendResetEmailtoken($request->email, $tokenData->token)) {
            return redirect()->back()->with('success', trans('A reset link has been sent to your email address.'));
        } else {
            return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        }

    }
        private function sendResetEmailtoken($email, $token)
            {
            //Retrieve the user from the database
            $user = DB::table('users')->where('email', $email)->select('email')->first();

            //Generate, the password reset link. The token generated is embedded in the link
            $link = config('base_url') . 'password/reset/' . $token . '?email=' .$user->email;
            
                try {
                //Here send the link with CURL with an external email API
                 /*Mail::to($request->email)->send($link); */
                 $data = array('name'=>"Geohomes");
              Mail::send(['text'=>'Geohomes'],$data, function($message) {
                 $message->to($request->email, $link )->subject
                    ('Password Reset');
              });
                    return true;
                } catch (\Exception $e) {
                    return false;
                }
            }
      
    


        public function CreateNewPassword(Request $request)
        {
            //Validate input
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|confirmed',
                'token' => 'required' ]);

            //check if payload is valid before moving on
            if ($validator->fails()) {
                return redirect()->back()->withErrors(['email' => 'Please complete the form']);
            }

            $password = $request->password;
        // Validate the token
            $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();
        // Redirect the user back to the password reset request form if the token is invalid
            if (!$tokenData) return view('password.reset_password_link');

            $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
            if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
        //Hash and update the new password
            $user->password = \Hash::make($password);
            $user->update(); //or $user->save();

            //login the user immediately they change password successfully
            Auth::login($user);

            //Delete the token
            DB::table('password_resets')->where('email', $user->email)
            ->delete();

            //Send Email Reset Success Email
            if ($this->sendSuccessEmail($tokenData->email)) {
                return view('login');
            } else {
                return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
            }

        }

}

