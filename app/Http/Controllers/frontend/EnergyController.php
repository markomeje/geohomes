<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class EnergyController extends Controller
{
    //

     public function index()
    {
        $fetch = DB::table('energy')->paginate(1);
         $energy = json_decode(json_encode($fetch ), true);
        return view('frontend.energys', ['energy'=>$fetch]);
    }
}
