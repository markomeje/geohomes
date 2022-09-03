<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AboutController extends Controller
{
    public function index()
    {
        $fetch = DB::table('about')->paginate(1);
         $about = json_decode(json_encode($fetch ), true);
        return view('frontend.about', ['about'=>$fetch]);
    }
}
