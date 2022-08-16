<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\password;
use App\Models\User;



class ResetPasswordController extends Controller
{

    public function admin()
    {
        return view('password.reset_password_link');
    }


 //sending password reset link
    public function verify($token = '')
    {   
        $verify = self::check($token);
        $expired = !Carbon::parse($verify['data']->created_at ?? null)->addMinutes($minutes = 1440)->gt(Carbon::now());
        return view('password.verify', ['title' => 'Password Reset | Geohomes', 'token' => $verify['data']->token ?? null, 'expired' => $expired, 'user' => $verify['user'] ?? null]);
    }

    private static function check($token = '') {
        $reset = Password::where(['token' => $token])->latest()->first();
        return ['data' => $reset, 'user' => User::where(['email' => $reset->email ?? null])->first()];
    }

}

