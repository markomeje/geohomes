<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;

class ConsultantsFormTableController extends Controller
{
//
    public function admin()
    {
        $fetch = DB::table('consultants')->get();
        $array = json_decode(json_encode($fetch ), true);
        return view('admin.consultant_table', ['array'=>$array]);
    }

    public function delete($id) {
        if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');

  }
        $delet=DB::delete('delete from consultants where id = ?',[$id]);

        if ($delet) {
            return back()->with('success', 'Record deleted successfully');

        }

        else{
            return back()->with('error', 'Record was not deleted. please try Again.');
        }
    }

    /* For inserting into Consultant Form Table */
    public function ConsultantForm()
    {
        if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }
        return view('admin.consultantform');
    }


    /* for consultants form submission */

    public function InsertConsultantForm(Request $request){
            if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }
        $data = request()->all();
        $validator = Validator::make($data, [  
            'name' => ['required'],
            'middlename' => ['required'],
            'surname' => ['required'],
            'phone' => ['required'],
            'email' => ['required','email'],
            'residential' => ['required'],
            'office' => ['required'],
            'kin-name' => ['required'],
            'kin-address' => ['required'],
            'kin-relation' => ['required'],
            'prepared-who' => ['required'],
            'account-name' => ['required'],
            'account-number' => ['required'],
            'bank' => ['required'],
            'company-line' => ['required'],
            'company-email' => ['required'],  
        ]);

        if ($validator->fails()) {
            return back()
            ->withInput()
            ->withErrors($validator);
        }

        else{

            $firstname = $request->input('name');
            $miidlename = $request->input('middlename');
            $surname = $request->input('surname');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $residential_address = $request->input('residential');
            $office_address = $request->input('office');
            $kin_name = $request->input('kin-name');
            $kin_address = $request->input('kin-address');
            $kin_relation = $request->input('kin-relation');
            $prepared_who = $request->input('prepared-who');
            $account_name = $request->input('account-name');
            $account_number = $request->input('account-number');
            $bank = $request->input('bank');
            $company_line = $request->input('company-line');
            $company_email = $request->input('company-email');

            $data=array(
                'firstname'=>$firstname,
                'middlename'=>$miidlename,
                'surname'=>$surname,
                'phone'=>$phone,
                'email'=>$email,
                'residential_address'=>$residential_address,
                'office_address'=>$office_address,
                'kin_name'=>$kin_name,
                'kin_address'=>$kin_address,
                'kin-relation'=>$kin_relation,
                'prepared_by'=>$prepared_who,
                'account_name'=>$account_name,
                'account_number'=>$account_number,
                'bank'=> $bank,
                'company_phone'=>$company_line,
                'company_email'=>$company_email,

            );
            $submit= DB::table('consultants')->insert($data);

            if ($submit) {
                return back()->with('success', 'Sumission successful');

            }

            else{
                return back()->with('error', 'Submission Failed. please try Again.');
            }
        }
    }
    /*for Viewing the consultant Page */
     public function viewConsultant($id)
    {
        if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');

  }
        $fetch = DB::table('consultants')
        ->where('id', $id)
        ->get();
        $consultant = json_decode(json_encode($fetch ), true);
        return view('admin.view.view_consultant', ['consultant'=>$consultant]);
    }

    /* For Editing Consultant Form */

    public function editForm($id)
    {
        if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }
        $fetch = DB::table('consultants')
        ->where('id', $id)
        ->get();
        $consultant = json_decode(json_encode($fetch ), true);
        return view('edit.consultantformedit', ['consultant'=>$consultant]);
    }


    public function Edit(Request $request)
    {
        if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }

        $data = request()->all();
        $validator = Validator::make($data, [  
            'firstname' => ['required'],
            'middlename' => ['required'],
            'surname' => ['required'],
            'phone' => ['required'],
            'email' => ['required','email'],
            'residential' => ['required'],
            'office' => ['required'],
            'kin_name' => ['required'],
            'kin_address' => ['required'],
            'kin_relation' => ['required'],
            'prepared_who' => ['required'],
            'account_name' => ['required'],
            'account_number' => ['required'],
            'bank' => ['required'],
            'company_phone' => ['required'],
            'company_email' => ['required'], 
        ]);


        if ($validator->fails()) {
            return back()
            ->withInput()
            ->withErrors($validator);
        }

        else{

            $firstname = $request->input('firstname');
            $middlename = $request->input('middlename');
            $surname = $request->input('surname');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $residential = $request->input('residential');
            $office = $request->input('office');
            $kin_name= $request->input('kin_name');
            $kin_address = $request->input('kin_address');
            $kin_relation = $request->input('kin_relation');
            $prepared_who = $request->input('prepared_who');
            $account_name= $request->input('account_name');
            $account_number = $request->input('account_number');
            $bank = $request->input('bank');
            $company_line = $request->input('company_phone');
            $company_email= $request->input('company_email');
            $id = $request->input('id');


            $edit=DB::table('consultants')
            ->where('id', $id)
            ->update([
                'firstname' =>"$firstname",
                'middlename' => "$middlename",
                'surname' => "$surname",
                'phone' => "$phone",
                'email' => "$email",
                'residential_address' => "$residential",
                'office_address' => "$office",
                'kin_name' => "$kin_name",
                'kin_address' => "$kin_address",
                'kin-relation' => "$kin_relation",
                'prepared_by' => "$prepared_who",
                'account_name' => "$account_name",
                'account_number' => "$account_number",
                'bank' => "$bank",
                'company_phone' => "$company_line",
                'company_email' => "$company_email",]); 



            if ($edit) {
                return back()->with('success', 'Record Updated successfully');

            }

            else{
                return back()->with('error', 'Record was not Updated. please try Again.');
            }
        }

    }
}
