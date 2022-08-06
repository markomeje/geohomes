<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    //
     public function admin()
    {
        $fetch = DB::table('users')->get();
         $user = json_decode(json_encode($fetch ), true);
        return view('usertable', ['user'=>$fetch]);
        
    }
}
