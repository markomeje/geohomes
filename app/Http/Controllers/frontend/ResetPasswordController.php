<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\{User, password};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordReset;
use Validator;
use Auth;




class ResetPasswordController extends Controller
{

    public function admin()
    {
        return view('frontend.password.reset_password_link');
    }



    public function Resetpasswordlink(Request $request)
    {

        {
        $data = request()->only('email');
        $validator = Validator::make($data, [
            'email' => ['required', 'email']
        ]);

        if (!$validator->passes()) {
            return redirect()->back()->with('error', 'please complete the form with correct email.');
            
        }

        $token =Str::random(60);
        $email = $data['email'];
        password::where(['email' => $email])->delete();
        password::insert([
            'email' => $email, 
            'token' => $token,
            'duration' => 24, //24hours
        ]);

        try {
            $mail = new PasswordReset([
                'email' => $email, 
                'token' => $token
            ]);

            Mail::to($email)->send($mail);
          return redirect()->back()->with('success', 'A link has been sent to your email.');

        } catch (Exception $error) {
            return redirect()->back()->with('error', 'Network error or invalid email.');
        }
    }
} 

    public function NewPasswordForm()
    {
        return view('frontend.password.create_password');
    }

    public function CreateNewPassword()
        {
        $data = request()->only('password', 'confirmpassword', 'email');
        $validator = Validator::make($data, [
            'password' => ['required', 'min:8'],
            'confirmpassword' => ['required'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        if ($data['password'] !== $data['confirmpassword']) {
            return response()->json([
                'status' => 0,
                'info' => 'Passwords do not match.'
            ]);
        }

        $email = $data['email'] ?? null;
        if (empty($email)) {
            return redirect()->back()->with('error', 'Invalid Operation');
        }

        $user = User::where(['email' => $email])->first();
        $user->password = Hash::make($data['password']);
        $updated = $user->update();
        if($updated) {
            Password::where(['email' => $email])->delete();
            return redirect(route('login'))->with('success', 'your password has been changed.');
        }
        else{
        return redirect()->back()->with('error', 'operation Failed. Please try again.');
        }
    }
}
