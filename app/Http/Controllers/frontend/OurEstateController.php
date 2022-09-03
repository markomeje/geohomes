<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OurEstateController extends Controller
{
     public function index()
    {

        $fetch = DB::table('portifolio')->paginate(4);
         $portifolio = json_decode(json_encode($fetch ), true);
        return view('frontend.our-estate', ['portifolio'=> $fetch]);
    }
       
}
