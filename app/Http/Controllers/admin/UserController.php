<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

     public function delete($id) {

        $delet=DB::delete('delete from users where id = ?',[$id]);

        if ($delet) {
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
}
