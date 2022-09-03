<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;

class PSRTableController extends Controller
{
//
    public function admin()
    {
        $fetch = DB::table('propertysearchs')->get();
        $array = json_decode(json_encode($fetch ), true);
        return view('admin.property_table', ['array'=>$array]);
    }

    public function delete($id) {
        if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');
  }
        $delet=DB::delete('delete from propertysearchs where id = ?',[$id]);

        if ($delet) {
            return back()->with('success', 'Record deleted successfully');

        }

        else{
            return back()->with('error', 'Record was not deleted. please try Again.');
        }
    }


    /* For Inserting data into Database */

    public function PSRForm()
    {
        if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');
  }
        return view('admin.propertyform');
    }


    /* for Property Search Request form submission */

    public function InsertPSR(Request $request){
        if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');
  }
//Validation //
        $data = request()->all();
        $validator = Validator::make($data, [  
            'name' => ['required'],
            'phone' => ['required'],
            'email' => ['required','email'],
            'residential_address' => ['required'],
            'office_address' => ['required'],
            'plot_number' => ['required'],
            'location' => ['required'],
            'inspection_date' => ['required'],
            'approved_by' => ['required'],
            'customer' => ['required'],
            'survey_payment' => ['required'],
            'payment_status' => ['required'],

        ]);

        if ($validator->fails()) {
            return back()
            ->withInput()
            ->withErrors($validator);
        }

        else{

            $name = $request->input('name');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $residential = $request->input('residential_address');
            $office_address = $request->input('office_address');
            $plot_number = $request->input('plot_number');
            $location = $request->input('location');
            $inspection_date= $request->input('inspection_date');        
            $approved_by= $request->input('approved_by');
            $customer = $request->input('customer');
            $survey_payment = $request->input('survey_payment');
            $payment_status = $request->input('payment_status');
            $date = $request->input('date');


            $data=array(
                'clientname'=>$name,
                'phone'=>$phone,
                'email'=>$email,
                'residential_address'=>$residential,
                'office_address'=>$office_address,
                'plot_number'=>$plot_number,
                'layout'=>$location ,
                'person'=>$customer,
                'inspection_date'=>$inspection_date,
                'survey_payment'=>$survey_payment,
                'status'=> $payment_status,
                'approved_by'=>$approved_by,

            );
            $submit= DB::table('propertysearchs')->insert($data);

            if ($submit) {
                return back()->with('success', 'Sumission successful');

            }

            else{
                return back()->with('error', 'Submission Failed. please try Again.');
            }
        }
    }
     public function viewPSRT($id)
    {
        if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');
  }
        $fetch = DB::table('propertysearchs')
        ->where('id', $id)
        ->get();
        $property = json_decode(json_encode($fetch ), true);
        return view('admin.view.view_property', ['property'=>$property]);
    }


    /* For Editing Property Search Table */

    public function editForm($id)
    {     
        if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');
  }
        $fetch = DB::table('propertysearchs')
        ->where('id', $id)
        ->get();
        $property = json_decode(json_encode($fetch ), true);
        return view('admin.edit.propertyformedit', ['property'=>$property]);
    }

   
    public function Edit(Request $request)
    {
        if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');
  }
//Validation //
        $data = request()->all();
        $validator = Validator::make($data, [  
            'name' => ['required'],
            'phone' => ['required'],
            'email' => ['required','email'],
            'residential' => ['required'],
            'office' => ['required'],
            'plot_number' => ['required'],
            'layout' => ['required'],
            'customer' => ['required'],
            'inspection_date' => ['required'],
            'survey_payment' => ['required'],
            'payment_status' => ['required'],
            'approved_by' => ['required'],
            'registration_date' => ['required'], 
        ]);

        if ($validator->fails()) {
            return back()
            ->withInput()
            ->withErrors($validator);
        }

        else{

            $name = $request->input('name');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $residential = $request->input('residential');
            $office_address = $request->input('office');
            $plot_number = $request->input('plot_number');
            $layout = $request->input('layout');
            $customer = $request->input('customer');
            $inspection_date= $request->input('inspection_date');
            $survey_payment = $request->input('survey_payment');
            $payment_status = $request->input('payment_status');
            $approved_by= $request->input('approved_by');
            $registration_date = $request->input('date');

            $id = $request->input('id');


            $edit=DB::table('propertysearchs')
            ->where('id', $id)
            ->update([
                'clientname'=>"$name",
                'phone'=>"$phone",
                'email'=>"$email",
                'residential_address'=>"$residential",
                'office_address'=>"$office_address",
                'plot_number'=>"$plot_number",
                'layout'=>"$layout",
                'person'=>"$customer",
                'inspection_date'=>"$inspection_date",
                'survey_payment'=>"$survey_payment",
                'status'=>"$payment_status",
                'approved_by'=>"$approved_by",
                'registration_date'=>"$registration_date",]); 



            if ($edit) {
                return back()->with('success', 'Record Updated successfully');

            }

            else{
                return back()->with('error', 'Record was not Updated. please try Again.');
            }
        }

    }
}
