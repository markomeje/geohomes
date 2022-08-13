<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{

    public function passwordResetForm()
    {
        return view('password.reset_password_link');
    }


     public function newPasswordForm($token)
    {
        return view('password.reset_password', ['token' => $token]);
    }


 //sending password reset link
    public function sendPasswordResetLink(Request $request){

        $request->validate(['email' => 'required|email']);

        $user =User::whereEmail($request->email)->first();

        if ($user == null) {
            return redirect()->back()->with(['error'=>'Sorry, the Email Address does not exist.']);
        }

        else{  

        $status = Password::sendResetLink(
            $request->only('email')
        );
        
        if ($status) {
            return redirect()->back()->with('success', 'password reset link has been sent to your email. thank you.');
        }

        else{
           return redirect()->back()->with('error', 'A network Error occurred.please try again');
        }

         }
    }


        //Saving the new password in Database

         public function Resetpassword(Request $request){
              $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);

        }

/*    $schedule->command('auth:clear-resets')->everyFifteenMinutes();*/

       /* //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' =>  Str::random(60),
            'created_at' => Carbon::now()
        ]);
        
        
        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();
          $sentmail= $this->sendResetEmail($request->email, $tokenData->token);
            dd($sentmail);
        if ($sentmail){
            return redirect()->back()->with('success','A reset link has been sent to your email address.');
        } 
        else {
            return redirect()->back()->with('error','A Network Error occurred. Please try again.');

        }

   }

    private function sendResetEmail($email, $token)
            {
            //Retrieve the user from the database
            $user = DB::table('users')->where('email', $email)->select('role', 'email')->first();
            //Generate, the password reset link. The token generated is embedded in the link
            $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);

                try {
                //Here send the link with CURL with an external email API 
                    return true;
                } catch (\Exception $e) {
                    return false;
                }
            }




        public function createPassword(Request $request)
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
            if (!$tokenData) return view('auth.passwords.email');

            $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
            if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
        //Hash and update the new password
            $user->password = Hash::make($password);
            $user->update(); //or $user->save();

            //login the user immediately they change password successfully
            Auth::login($user);

            //Delete the token
            DB::table('password_resets')->where('email', $user->email)
            ->delete();

            //Send Email Reset Success Email
            if ($this->sendSuccessEmail($tokenData->email)) {
                return view('index');
            } else {
                return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
            }

        }*/

}
