<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;
class ConsultancyPageTableController extends Controller
{
//

 public function admin()
 {
  $fetch = DB::table('consultancy')->paginate(8);
  $consultancy = json_decode(json_encode($fetch ), true);
  return view('admin.consultancy_table', ['consultancy'=> $fetch]);
 }

 public function delete($id) {
  if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');

  }

  $delet=DB::delete('delete from consultancy where id = ?',[$id]);

  if ($delet) {
   return back()->with('success', 'Record deleted successfully');

  }

  else{
   return back()->with('error', 'Record was not deleted. please try Again.');
  }
 }

 /* for adding Consultancy Table */

 public function addConsultancyForm()
 {
  if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }

  return view('admin.add_consultancy');
 }

 public function ConsultancyInsert(Request $request)
 {
  if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }

  $data = request()->all();
  $validator = Validator::make($data, [ 
   'title' => ['required'], 
   'firstdescription' => ['required'], 
   'seconddescription' => ['required'],
   'firstimage' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
   'secondimage' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],

  ]);

  if ($validator->fails()) {
   return response()->json([
    'status' => 0,
    'error' => $validator->errors()
   ]);
  }

  $firstimage = request()->file('firstimage');
  $secondimage = request()->file('secondimage');
  $extension = $firstimage->getClientOriginalExtension();
  $firstfilename = Str::uuid().'.'.$extension;
  $path = 'assets/upload/consultancy_images';
  $firstimage->move($path, $firstfilename);

  $extension = $secondimage->getClientOriginalExtension();
  $secondfilename = Str::uuid().'.'.$extension;
  $path = 'assets/upload/consultancy_images';
  $secondimage->move($path, $secondfilename);


  $request=array([
   'title' => $request['title'],
   'firstdescription' => $request['firstdescription'],
   'seconddescription' => $request['seconddescription'],
'firstimage' => $firstfilename, // save full image path to database
'secondimage' => $secondfilename, // save full image path to database
]);

  $submit= DB::table('consultancy')->insert($request);

  if ($submit) {
   return back()->with('success', 'content added Successfully. please click on consultancy to view it.');

  }

  else{
   return back()->with('error', 'Sorry, Content was not Added. Please try Again.');
  }
 }

/* This code handle the viewing of consultancy page */
 public function viewConsultancy($id)
 {
  if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');

  }

  $fetch = DB::table('consultancy')
  ->where('id', $id)
  ->get();;
  $consultancy = json_decode(json_encode($fetch ), true);
  return view('admin.view.view_consultancy', ['consultancy'=>$consultancy]);
 }

 /* For Editing consultancy Page */

 public function editForm($id)
 {
  if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }

  $fetch = DB::table('consultancy')
  ->where('id', $id)
  ->get();
  $consultancy = json_decode(json_encode($fetch ), true);
  return view('admin.edit.consultancyedit', ['consultancy'=>$consultancy]);
 }

 public function Edit(Request $request)
 {
  if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }

  $data = request()->all();
  $validator = Validator::make($data, [ 
   'title' => ['required'], 
   'firstdescription' => ['required'], 
   'seconddescription' => ['required'],
   'firstimage' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
   'secondimage' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],

  ]);


  if ($validator->fails()) {
   return response()->json([
    'status' => 0,
    'error' => $validator->errors()
   ]);
  }

  else{

   $firstimage = request()->file('firstimage');
   $secondimage = request()->file('secondimage');
   $extension = $firstimage->getClientOriginalExtension();
   $firstfilename = Str::uuid().'.'.$extension;
   $path = 'assets/upload/consultancy_images';
   $firstimage->move($path, $firstfilename);

   $extension = $secondimage->getClientOriginalExtension();
   $secondfilename = Str::uuid().'.'.$extension;
   $path = 'assets/upload/consultancy_images';
   $secondimage->move($path, $secondfilename);


   $title = $request->input('title');
   $firstdescription = $request->input('firstdescription');
   $seconddescription = $request->input('seconddescription');
   $id = $request->input('id');

   $edit=DB::table('consultancy')
   ->where('id', $id)
   ->update([
    'title' => "$title",
    'firstdescription' => "$firstdescription",
    'seconddescription' => "$seconddescription",
    'firstimage' => "$firstfilename",
    'secondimage' => "$secondfilename",
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
