<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class RealEstateController extends Controller
{


    public function index()
    {
         
         $fetch = DB::table('estate')->paginate(1);
         $estate = json_decode(json_encode($fetch ), true);
        return view('frontend.real-estate', ['estate'=> $fetch]);
    }

}
