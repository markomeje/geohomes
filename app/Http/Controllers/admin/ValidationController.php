<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Validator;
use Auth;
use DB;
use Hash;

class ValidationController extends Controller
{
    //
 public function checklogin(Request $request){

        $data = array(
            'email'=>$request->post('user_email'),
            'password'=>$request->post('user_pass'),
        );

        if(auth() -> attempt($data)){

            request()->session()->regenerate();
            return redirect()->route('dashboard');

        }

        else{

            return back()->with('error', 'Invalid credentials. Try agin.');
        }

        function successLogin(){         

            return view('dashboard');
        }
    }

    public function passwordreset(Request $request){

         $data = request()->all();
        $validator = Validator::make($data, [  
        'user_email' => ['required','email','max:255'],
        'password' => ['required','confirmed','max:255'],
        ]);

        if ($validator->fails()) {
         return back()
         ->withInput()
         ->withErrors($validator);
         
        }

        else{
        $email = $request->input('user_email');
        $password = $request->input('password');
        $hashed_password=Hash::make($password);
        
        $updated=DB::table('users')
            ->where('email', $email)
            ->update([
                'password' => "$hashed_password"]);
               


        if ($updated) {
              return redirect()->back()->with('success', 'You password has been changed. please login.');

        }

           else{
            return back()->with('error', 'sorry the system could not reset your password.try again.');
           }
        }
    }

    

}