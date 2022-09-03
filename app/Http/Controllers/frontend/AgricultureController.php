<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AgricultureController extends Controller
{
    //
     public function index()
    {
        $fetch = DB::table('agriculture')->paginate(1);
         $agriculture = json_decode(json_encode($fetch ), true);
        return view('frontend.agriculture', ['agriculture'=>$fetch]);
    }
}
