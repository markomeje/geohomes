<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use DB;
use Validator;
use Str;

class AboutTableController extends Controller
{
//
 public function admin()
 {
  $fetch = DB::table('about')->get();
  $about = json_decode(json_encode($fetch ), true);
  return view('admin.about-table', ['about'=>$fetch ]);
 }

 public function delete($id) {

  if (Gate::denies('delete')) {
    return back()->with('error', 'Sorry, you are not allowed to delete this file.');

  }

  $delet=DB::delete('delete from about where id = ?',[$id]);

  if ($delet) {
   return redirect()->back()->with('success', 'Record deleted successfully');

  }

  else{
   return back()->with('error', 'Record was not deleted. please try Again.');
  }
 }

 /* for inserting data into the about form */
 public function addAboutForm()
 {
  if (Gate::denies('create')) {
    return back()->with('error', 'Sorry, you are not allowed to create any document on this page.');

  }
  return view('admin.addabout');
 }

 public function AboutInsert(Request $request)
 {
if (Gate::denies('create')) {
    return back()->with('error', 'Sorry, you are not allowed to create any document on this page.');

  }

  $data = request()->all();
  $validator = Validator::make($data, [  
   'title' => ['required'],
   'description' => ['required'],
  ]);

  if ($validator->fails()) {
   return response()->json([
    'status' => 0,
    'error' => $validator->errors()
   ]);
  }

  $request=array([
   'title' => $request['title'],
   'description' => $request['description'],
  ]);

  $submit= DB::table('about')->insert($request);

  if ($submit) {
   return back()->with('success', 'You have successfully Added Content. Thank You.');

  }

  else{
   return back()->with('error', 'content was not Added. Please try Again.');
  }
 }


 public function viewAbout($id)
 {
if (Gate::denies('view')) {
    return back()->with('error', 'Access denied.');

  }
  $fetch = DB::table('about')
  ->where('id', $id)
  ->get();
  $about = json_decode(json_encode($fetch ), true);
  return view('admin.view.view_about', ['about'=>$about]);
 }



 /*This Code handles The Editing of About Page */
 public function editForm($id)
 {
if (Gate::denies('update')) {
    return back()->with('error', 'Sorry, You can not Edit this page');

  }
  $fetch = DB::table('about')
  ->where('id', $id)
  ->get();
  $about = json_decode(json_encode($fetch ), true);
  return view('admin.edit.editabout', ['about'=>$about]);
 }

 public function Edit(Request $request)
 {
if (Gate::denies('update')) {
    return back()->with('error', 'Sorry, You can not Edit this page');

  }
  
  $data = request()->all();
  $validator = Validator::make($data, [  
   'title' => ['required'],
   'description' => ['required'],
  ]);

  if ($validator->fails()) {
   return response()->json([
    'status' => 0,
    'error' => $validator->errors()
   ]);
  }
  else{

   $title = $request->input('title');
   $description = $request->input('description');
   $id = $request->input('id');


   $edit=DB::table('about')
   ->where('id', $id)
   ->update([
    'title' => "$title",
    'description' => "$description",]);



   if ($edit) {
    return back()->with('success', 'Record Updated successfully');

   }

   else{
    return back()->with('error', 'Record was not Updated. please try Again.');
   }
  }
 }

}

