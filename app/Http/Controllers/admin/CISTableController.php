<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;

class CISTableController extends Controller
{
//
    /* Selection of file from DB */
    public function admin()
    {
        $fetch = DB::table('cis')->get();
        $array = json_decode(json_encode($fetch ), true);
        return view('admin.cis_table', ['array'=>$array]);
    }
    /* deleting of files from DB */
    public function delete($id) {

          if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');

  }

        $delet=DB::delete('delete from cis where id = ?',[$id]);

        if ($delet) {
            return back()->with('success', 'Record deleted successfully');

        }

        else{
            return back()->with('error', 'Record was not deleted. please try Again.');
        }
    }

    /* Form Inserting CIS Form Into the Database */

    public function CISForm()
    {
      if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }


        return view('admin.cisform');
    }

    /* for CIS form submission */

    public function CisInsert(Request $request){
     if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }

        $data = request()->all();
        $validator = Validator::make($data, [  
            'name' => ['required'],
            'phone' => ['required'],
            'email' => ['required','email'],
            'residential' => ['required'],
            'occupation' => ['nullable'],
            'date_of_birth' => ['required'],
            'plot_number' => ['required'],
            'lifted' => ['required'],
            'layout' => ['required'],
            'agent_name' => ['required'],
            'agent_phone' => ['required'],
            'agent_address' => ['required'],
            'agent_occupation' => ['required'],
            'agent_office' => ['required'],


        ]);

        if ($validator->fails()) {
            return back()
            ->withInput()
            ->withErrors($validator);
        }

        else{

            $fullname = $request->input('name');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $residential_address = $request->input('residential');
            $occupation =$request->input('occupation');
            $date_of_birth = $request->input('date_of_birth');
            $plot_number = $request->input('plot_number');
            $lifted=$request->input('lifted');
            $amount=$request->input('amount');
            $layout = $request->input('layout');
            $agent_name = $request->input('agent_name');
            $agent_phone = $request->input('agent_phone');
            $agent_address= $request->input('agent_address');
            $agent_occupation = $request->input('agent_occupation');
            $agent_office = $request->input('agent_office');

            $calculated_amount=$plot_number * 24000;


            $data=array(
                'fullname'=>$fullname,
                'phone' =>$phone,
                'email' =>$email,
                'residential_address' =>$residential_address,
                'occupation' =>$occupation,
                'DOB' =>$date_of_birth,
                'plot_number' =>$plot_number,
                'lifted' =>$lifted,
                'layout' =>$layout,
                'amount' =>$calculated_amount,
                'agent_name' =>$agent_name,
                'agent_phone' => $agent_phone,
                'agent_address'=> $agent_address,
                'agent_occupation' => $agent_occupation,
                'agent-office_address'=> $agent_office,  
            );
            $submit= DB::table('cis')->insert($data);

            if ($submit) {
                return back()->with('success', 'Sumission successful');

            }

            else{
                return back()->with('error', 'Submission Failed. please try Again.');
            }
        }
    }

    /* For Editing Client Inpection Form */
    public function editForm($id)

    {
        if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }

        $fetch = DB::table('cis')
        ->where('id', $id)
        ->get();
        $cis = json_decode(json_encode($fetch ), true);
        return view('admin.edit.cisformedit', ['cis'=>$cis]);
    }

    public function viewCIS($id)
    {
        if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');

  }

        $fetch = DB::table('cis')
        ->where('id', $id)
        ->get();
        $cis = json_decode(json_encode($fetch ), true);
        return view('admin.view.view_cis', ['cis'=>$cis]);
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
            'phone' => ['required'],
            'residential' => ['required'],
            'occupation' => ['required'],
            'date_of_birth' => ['required'],
            'plot_number' => ['required'],
            'lifted' => ['required'],
            'layout' => ['required'],
            'agent_name' => ['required'],
            'agent_phone' => ['required'],
            'agent_address' => ['required'],
            'agent_occupation' => ['required'], 
            'agent_office' => ['required'],

        ]);


        if ($validator->fails()) {
            return back()
            ->withInput()
            ->withErrors($validator);
        }

        else{

            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $residential = $request->input('residential');
            $occupation = $request->input('occupation');
            $dob= $request->input('date_of_birth');
            $plot_number = $request->input('plot_number');
            $lifted = $request->input('lifted');
            $layout= $request->input('layout');
            $amount = $request->input('amount');
            $agent_name = $request->input('agent_name');
            $agent_phone = $request->input('agent_phone');
            $agent_address = $request->input('agent_address');
            $agent_occupation= $request->input('agent_occupation');
            $agent_office= $request->input('agent_office');
            $id = $request->input('id');

            $calculated_amount=$plot_number * 24000;

            $edit=DB::table('cis')
            ->where('id', $id)
            ->update([
                'fullname' =>"$name",
                'phone' => "$phone",
                'email' => "$email",
                'residential_address' => "$residential",
                'occupation' => "$occupation",
                'DOB' => "$dob",
                'plot_number' => "$plot_number",
                'lifted' => "$lifted",
                'layout' => "$layout",
                'amount' => "$calculated_amount",
                'agent_name' => "$agent_name",
                'agent_phone' => "$agent_phone",
                'agent_address' => "$agent_address",
                'agent_occupation' => "$agent_occupation",
                'agent-office_address' => "$agent_office",]); 



            if ($edit) {
                return back()->with('success', 'Record Updated successfully');

            }

            else{
                return back()->with('error', 'Record was not Updated. please try Again.');
            }
        }

    }

}
