<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Validator;
use Auth;

class LogoutController extends Controller
{
    //
 public function logout()
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->invalidate();

        foreach(request()->cookie() as $email => $value) {
            Cookie::queue(Cookie::forget($email));
        }
        return view('admin.login');
    }
}
