<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
class AffiliateTableController extends Controller
{
//
 public function admin()
 {
  $fetch = DB::table('affiliates')->get();
  $array = json_decode(json_encode($fetch ), true);
  return view('admin.affiliate_table', ['array'=>$array]);
 }

 public function delete($id) {
    
if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');

  }

  $delet=DB::delete('delete from affiliates where id = ?',[$id]);

  if ($delet) {
   return back()->with('success', 'Record deleted successfully');

  }

  else{
   return back()->with('error', 'Record was not deleted. please try Again.');
  }
 }

 /* This code handles editing of affiliate table */
 public function editForm($id)
 {
if (Gate::denies('update')) {
    return back()->with('error', 'Sorry, You can not Edit this page');

  }
  $fetch = DB::table('affiliates')
  ->where('id', $id)
  ->get();
  $affiliate = json_decode(json_encode($fetch ), true);
  return view('admin.edit.affiliateformedit', ['affiliate'=>$affiliate]);
 }

 public function Edit(Request $request)
 {
if (Gate::denies('update')) {
    return back()->with('error', 'Sorry, You can not Edit this page');

  }

  $data = request()->all();
  $validator = Validator::make($data, [  
   'name' => ['required'],
   'email' => ['required', 'email'],
   'phone' => ['required'],
  ]);

  if ($validator->fails()) {
   return response()->json([
    'status' => 0,
    'error' => $validator->errors()
   ]);
  }
  else{

   $name = $request->input('name');
   $email = $request->input('email');
   $phone = $request->input('phone');
   $id = $request->input('id');


   $edit=DB::table('affiliates')
   ->where('id', $id)
   ->update([
    'name' => "$name",
    'email' => "$email",
    'phone' => "$phone",]);



   if ($edit) {
    return back()->with('success', 'Record Updated successfully');

   }

   else{
    return back()->with('error', 'Record was not Updated. please try Again.');
   }
  }
 }

}
