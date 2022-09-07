<?php


namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Hash;
use Validator;


class UserController extends Controller
{
    //
     public function admin()
    {
        $fetch = DB::table('users')->get();
         $user = json_decode(json_encode($fetch ), true);
        return view('admin.usertable', ['user'=>$fetch]);
        
    }

     public function adduser(Request $request){
         $request=array([
        'email' => $request['email'],
        'role' => $request['role'],
        'password' =>Hash::make($request['password']),
    ]);

         $submit= DB::table('users')->insert($request);

        if ($submit) {
            return back()->with('success', 'user has been created successful.');

    }

       else{
        return back()->with('error', 'Sorry, there was an error. please try again.');
       }
    }



     public function DeleteUser(Request $request,$id) {
       $deleted=DB::table('users')
        ->where('id', '==', $id);
        if ($deleted) {

          return back()->with('success', 'User has been successfully deleted ');

        }

        else{
          return back()->with('error', 'sorry,Your operation could not be completed. please try Again.');
        }
      }


     public function Update(Request $request)
 {

  
  $data = request()->all();
  $validator = Validator::make($data, [  
   'email' => ['required'],
   'role' => ['required'],
   'password' => ['required'],
  ]);

  if ($validator->fails()) {
   return response()->json([
    'status' => 0,
    'error' => $validator->errors()
   ]);
  }
  else{

   $email = $request->input('email');
   $role = $request->input('role');
   $password = $request->input('password');
   $hashedPassword=Hash::make($password);
   $id = $request->input('id');


   $updated=DB::table('users')
   ->where('id', $id)
   ->update([
    'email' => "$email",
    'role' => "$role",
    'password' => "$hashedPassword",]);

   if ($updated) {
    return back()->with('success', 'User Updated successfully');

   }

   else{
    return back()->with('error', 'User Update failed. please try Again.');
   }
  }
 }


/* Functions for Access Grant To USER */
 public function GrantCreateAccess(Request $request,$id)
 {
    DB::table('users')
   ->where('id', $id)
   ->update([
    'create' => "1"]);
    return redirect()->back()->with('success','Create Access granted to user ');
     

 }

 public function GrantViewAccess(Request $request,$id)
 {
    DB::table('users')
   ->where('id', $id)
   ->update([
    'view' => "1"]);
    return redirect()->back()->with('success','View Access granted to user ');
   
 }

 public function GrantUpdateAccess(Request $request,$id)
 {
    DB::table('users')
   ->where('id', $id)
   ->update([
    'update' => "1"]);
    return redirect()->back()->with('success','Update Access granted to user ');
 }

 public function GrantDeleteAccess(Request $request,$id)
 {
    DB::table('users')
   ->where('id', $id)
   ->update([
    'delete' => "1"]);
    return redirect()->back()->with('success','Delete Access granted to user ');
 }


/* Functions for Access Denying To USER */
 public function DenyCreateAccess(Request $request,$id)
 {
    DB::table('users')
   ->where('id', $id)
   ->update([
    'create' => "0"]);
    return redirect()->back()->with('success','Create Access denied to user ');
     

 }

 public function DenyViewAccess(Request $request,$id)
 {
    DB::table('users')
   ->where('id', $id)
   ->update([
    'view' => "0"]);
    return redirect()->back()->with('success','View Access denied to user ');
   
 }

 public function DenyUpdateAccess(Request $request,$id)
 {
    DB::table('users')
   ->where('id', $id)
   ->update([
    'update' => "0"]);
    return redirect()->back()->with('success','Update Access denied to user ');
 }

 public function DenyDeleteAccess(Request $request,$id)
 {
    DB::table('users')
   ->where('id', $id)
   ->update([
    'delete' => "0"]);
    return redirect()->back()->with('success','Delete Access denied to user ');
 }

}  

