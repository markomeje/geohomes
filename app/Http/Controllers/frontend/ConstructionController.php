<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ConstructionController extends Controller
{
     public function index()
    {
        $fetch = DB::table('construction')->paginate(1);
         $construction = json_decode(json_encode($fetch ), true);
        return view('frontend.construction', ['construction'=>$fetch]);
    }
}
