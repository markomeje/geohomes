<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MedicalController extends Controller
{
    //
       public function index()
    {
        $fetch = DB::table('medicals')->paginate(1);
         $medical = json_decode(json_encode($fetch ), true);
        return view('frontend.medical', ['medical'=>$fetch]);
    }
}
