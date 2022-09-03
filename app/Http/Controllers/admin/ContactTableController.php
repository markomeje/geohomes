<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;


class ContactTableController extends Controller
{
//
    public function admin()
    {
        $fetch = DB::table('contacts')->get();
        $array = json_decode(json_encode($fetch ), true);
        return view('admin.contact_table', ['array'=>$array]);
    }

    public function delete($id) {
          if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');

  }
        $delet=DB::delete('delete from contacts where id = ?',[$id]);

        if ($delet) {
            return back()->with('success', 'Record deleted successfully');

        }

        else{
            return back()->with('error', 'Record was not deleted. please try Again.');
        }
    }

    /* For Editing Contact Form */

    public function editForm($id)
    {
          if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }
        $fetch = DB::table('contacts')
        ->where('id', $id)
        ->get();
        $contact = json_decode(json_encode($fetch ), true);
        return view('admin.edit.contactedit', ['contact'=>$contact]);
    }

    public function Edit(Request $request)
    {
          if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }
        $data = request()->all();
        $validator = Validator::make($data, [  
            'name' => ['required'],
            'email' => ['required','email'],
            'message' => ['required'],

        ]);


        if ($validator->fails()) {
            return back()
            ->withInput()
            ->withErrors($validator);
        }

        else{

            $name = $request->input('name');
            $email = $request->input('email');
            $message = $request->input('message');
            $id = $request->input('id');


            $edit=DB::table('contacts')
            ->where('id', $id)
            ->update([
                'name' =>"$name",
                'email' => "$email",
                'message' => "$message",]); 



            if ($edit) {
                return back()->with('success', 'Record Updated successfully');

            }

            else{
                return back()->with('error', 'Record was not Updated. please try Again.');
            }
        }

    }

}
