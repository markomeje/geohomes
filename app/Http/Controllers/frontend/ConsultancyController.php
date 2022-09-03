<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ConsultancyController extends Controller
{

     public function index()
    {
        $fetch = DB::table('consultancy')->paginate(1);
         $consultancy = json_decode(json_encode($fetch ), true);
        return view('frontend.consultancy', ['consultancy'=>$fetch]);
    }
}
