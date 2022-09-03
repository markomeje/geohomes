<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{
     public function index()
    {
        $blog = DB::table('blogs')->paginate(8);

         $blogs = json_decode(json_encode($blog ), true);
        return view('frontend.frontendblog', ['blogs'=>$blog]);
    }

    public function blogdetail($id)
    {
        $fetch = DB::table('blogs')
        ->where('id', $id)
         ->get();
         $blogdetail = json_decode(json_encode($fetch ), true);
         $blogs = Blog::paginate(8);
         // dd($blogs);
        return view('frontend.blogdetail', ['blogdetail'=>$fetch, 'blogs' => $blogs]);

    }

    
}