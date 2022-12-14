<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;

class SiteInspectionTableController extends Controller
{
//
  public function admin()
  {
    $fetch = DB::table('siteinspections')->get();
    $array = json_decode(json_encode($fetch ), true);
    return view('admin.inspection_table', ['array'=>$array]);
  }

  public function delete($id) {

     if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');
  }
    $delet=DB::delete('delete from siteinspections where id = ?',[$id]);

    if ($delet) {
      return back()->with('success', 'Record deleted successfully');

    }

    else{
      return back()->with('error', 'Record was not deleted. please try Again.');
    }
  }

  /* For Inserting Into Site Inspection Table */

  public function siteInpectionForm()
  {
     if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');
  }

    return view('admin.siteform');
  }

  /* for Site Inspection form submission */

  public function InsertSiteInspection(Request $request){
 if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');
  }
//Validation //
    $data = request()->all();
    $validator = Validator::make($data, [  
      'name' => ['required'],
      'phone' => ['required'],
      'email' => ['required','email'],
      'residential' => ['required'],
      'date' => ['required'],
      'plot_number' => ['required'],
      'layout' => ['required'],
      'customer' => ['required'],
      'inspection_date' => ['required'],
      'survey_payment' => ['required'],
      'payment_status' => ['required'],
      'approved_by' => ['required'], 
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
      $date = $request->input('date');
      $plot_number = $request->input('plot_number');
      $layout = $request->input('layout');
      $customer= $request->input('customer');
      $inspection_date = $request->input('inspection_date');
      $payment_survey = $request->input('survey_payment');
      $payment_status = $request->input('payment_status');
      $approved_by = $request->input('approved_by');


      $data=array(
        'name'=>$fullname,
        'phone'=>$phone,
        'email'=>$email,
        'residential_address'=> $residential_address,
        'submission_date'=>$date,
        'plot_number'=>$plot_number,
        'layout'=>$layout,
        'person'=>$customer,
        'inspection_date'=>$inspection_date,
        'survey_payment'=>$payment_survey ,
        'status'=>$payment_status,
        'approved_by'=>$approved_by,

      );
      $submit= DB::table('siteinspections')->insert($data);

      if ($submit) {
        return back()->with('success', 'Sumission successful');

      }

      else{
        return back()->with('error', 'Submission Failed. please try Again.');
      }
    }
  }
  
 public function viewInspectionTable($id)
  {
     if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');
  }
    $fetch = DB::table('siteinspections')
    ->where('id', $id)
    ->get();
    $siteinspection = json_decode(json_encode($fetch ), true);
    return view('admin.view.view_siteinspection', ['siteinspection'=>$siteinspection]);
  }

  /* For Editing Sie Inspection Form in the Database */

  public function editForm($id)
  {
     if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');
  }
    $fetch = DB::table('siteinspections')
    ->where('id', $id)
    ->get();
    $siteinspection = json_decode(json_encode($fetch ), true);
    return view('admin.edit.siteformedit', ['siteinspection'=>$siteinspection]);
  }
 

  public function SiteInspectionEdit(Request $request)
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
      'submission_date' => ['required'],
      'plot_number' => ['required'],
      'layout' => ['required'],
      'customer' => ['required'],
      'inspection_date' => ['required'],
      'survey_payment' => ['required'],
      'payment_status' => ['required'],
      'approved_by' => ['required'],
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
      $submission_date = $request->input('submission_date');
      $plot_number = $request->input('plot_number');
      $layout = $request->input('layout');
      $customer = $request->input('customer');
      $inspection_date= $request->input('inspection_date');
      $survey_payment = $request->input('survey_payment');
      $payment_status = $request->input('payment_status');
      $approved_by= $request->input('approved_by');

      $id = $request->input('id');

      $edit=DB::table('siteinspections')
      ->where('id', $id)
      ->update([
        'name'=>"$name",
        'phone'=>"$phone",
        'email'=>"$email",
        'residential_address'=>"$residential",
        'submission_date'=>"$submission_date",
        'plot_number'=>"$plot_number",
        'layout'=>"$layout",
        'person'=>"$customer",
        'inspection_date'=>"$inspection_date",
        'survey_payment'=>"$survey_payment",
        'status'=>"$payment_status",
        'approved_by'=>"$approved_by",]); 



      if ($edit) {
        return back()->with('success', 'Record Updated successfully');

      }

      else{
        return back()->with('error', 'Record was not Updated. please try Again.');
      }
    }

  }

}
