<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;

class BlogTableController extends Controller
{
//
 public function admin()
 {
  $blogs = DB::table('blogs')->paginate(8);
  $blog = json_decode(json_encode($blogs), true);
  return view('admin.blog_table', ['blog'=>$blogs]);
 }


 public function delete($id) {


if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');

  }


  $delet=DB::delete('delete from blogs where id = ?',[$id]);

  if ($delet) {
   return back()->with('success', 'Record deleted successfully');

  }

  else{
   return back()->with('error', 'Record was not deleted. please try Again.');
  }

 }

 /* For Adding Data into the blog table in the database */

 public function addBlogForm()
 {

   if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }


  return view('admin.blogpost');
 }

 public function BlogInsert(Request $request)
 {

 if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }

  $image = request()->file('image');

//Validation //
  $data = request()->all();
  $validator = Validator::make($data, [  
   'name' => ['required'],
   'email' => ['required','email'],
   'blog_title' => ['required'],
   'image' => $image,
   'image' => ['required', 'image', 'mimes:jpg,png,jpeg,|max:10240'],
   'description' => ['required'],
  ]);


  if ($validator->fails()) {
   return back()
   ->withInput()
   ->withErrors($validator);
  }

  else{

   $extension = $image->getClientOriginalExtension();
   $filename = Str::uuid().'.'.$extension;
   $path = 'assets/upload/blog_images';
   $image->move($path, $filename);

   $request=array([
    'title' => $request['blog_title'],
    'description' => $request['description'],
    'writer' => $request['name'],
    'email' => $request['email'],
'image' => $filename, // save full image path to database
]);

   $submit= DB::table('blogs')->insert($request);

   if ($submit) {
    return back()->with('success', 'Blog Created Successful. Thank You.');

   }

   else{
    return back()->with('error', 'Post Was Not created. Please try Again.');
   }
  }

 }

 /* For Editing Blog */

 public function editForm($id)
 {

 if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }

  $fetch = DB::table('blogs')
  ->where('id', $id)
  ->get();
  $blog= json_decode(json_encode($fetch ), true);
  return view('admin.edit.blogedit', ['blog'=>$blog]);
 }

 public function viewBlogTable($id)
 {

   if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');

  }


  $fetch = DB::table('blogs')
  ->where('id', $id)
  ->get();
  $blog= json_decode(json_encode($fetch ), true);
  return view('admin.view.view_blog', ['blog'=>$blog]);
 }

 public function Edit(Request $request)
 {
  $data = request()->all();
  $validator = Validator::make($data, [ 
   'name' => ['required'], 
   'email' => ['required'],
   'title' => ['required'], 
   'description' => ['required'],
   'image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],

  ]);


  if ($validator->fails()) {
   return back()
   ->withInput()
   ->withErrors($validator);
  }

  else{

   $firstimage = request()->file('image');

   $extension = $firstimage->getClientOriginalExtension();
   $firstfilename = Str::uuid().'.'.$extension;
   $path = 'assets/upload/blog_images';
   $firstimage->move($path, $firstfilename);


   $title = $request->input('title');
   $description = $request->input('description');
   $name= $request->input('name');
   $email = $request->input('email');
   $id = $request->input('id');

   $edit=DB::table('blogs')
   ->where('id', $id)
   ->update([
    'title' => "$title",
    'description' => "$description",
    'writer' => "$name",
    'email' => "$email",
    'image' => "$firstfilename",

   ]);


   if ($edit) {
    return back()->with('success', 'Record Updated successfully');

   }

   else{
    return back()->with('error', 'Record was not Updated. please try Again.');
   }
  }
 }

}
