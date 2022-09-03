<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;

class ApplicationTableController extends Controller
{

    /* Fetching data from Application */
    public function admin()
    {
        $fetch = DB::table('applications')->get();
        $array = json_decode(json_encode($fetch ), true);
        return view('admin.application_table', ['array'=>$array ]);
    }


    public function delete($id) {

        if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');

  }

        $delete=DB::delete('delete from applications where id = ?',[$id]);

        if ($delete) {
            return back()->with('success', 'Record deleted successfully');

        }

        else{
            return back()->with('error', 'Record was not deleted. please try Again.');
        }
    }

    /* for Editing and view Application form */
    public function editForm($id)
    {
        if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }

        $fetch = DB::table('applications')
        ->where('id', $id)
        ->get();
        $application= json_decode(json_encode($fetch ), true);
        return view('admin.edit.applicationformedit', ['application'=>$application]);
    }

    public function view($id)
    {
        if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');

  }

        $fetch = DB::table('applications')
        ->where('id', $id)
        ->get();
        $application= json_decode(json_encode($fetch ), true);
        return view('admin.view.view_application', ['application'=>$application]);
    }


    public function Edit(Request $request)
    {
        if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }
        $data = request()->all();
        $validator = Validator::make($data, [  
            'name' => ['required'],
            'surname' => ['required'],
            'phone' => ['required'],
            'email' => ['required','email'],
            'date_of_birth' => ['required'],
            'gender' => ['required'],
            'marital_status' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
            'residential' => ['required'],
            'local_government_area' => ['required'],
            'organization' => ['required'],
            'office_address' => ['required'], 
            'property_type' => ['required'], 
        ]);

        if ($validator->fails()) {
            return back()
            ->withInput()
            ->withErrors($validator);
        }

        else{
            $name = $request->input('name');
            $surname = $request->input('surname');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $date_of_birth = $request->input('date_of_birth');
            $gender = $request->input('gender');
            $marital_status = $request->input('marital_status');
            $state= $request->input('state');
            $country= $request->input('country');
            $residential = $request->input('residential');
            $local_government_area = $request->input('local_government_area');
            $organization = $request->input('organization');
            $office_address = $request->input('office_address');
            $property_type = $request->input('property_type');

            $id = $request->input('id');

            $edit=DB::table('applications')
            ->where('id', $id)
            ->update([
                'name' => "$name ",
                'surname' => "$surname",
                'phone' => "$phone",
                'email' => "$email",
                'DOB' => "$date_of_birth",
                'gender' => "$gender",
                'marital_status' => "$marital_status",
                'residential_address' => "$state",
                'state' => "$country",
                'country' => "$residential",
                'LGA' => "$local_government_area",
                'organisation' => "$organization",
                'office_address' => "$office_address",
                'property_type' => "$property_type",


            ]);


            if ($edit) {
                return back()->with('success', 'Record Updated successfully');

            }

            else{
                return back()->with('error', 'Record was not Updated. please try Again.');
            }
        }
    }

    /* For Inserting into Application Table */

    public function ApplicationForm()
    {    

        if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }

        return view('applicationform');
    }

    /* for Application form submission */

    public function InsertApplicationForm(Request $request){
            if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }

//Validation //
        $data = request()->all();
        $validator = Validator::make($data, [  
            'name' => ['required'],
            'surname' => ['required'],
            'phone' => ['required'],
            'email' => ['required','email'],
            'date_of_birth' => ['required'],
            'gender' => ['required'],
            'marital_status' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
            'residential' => ['required'],
            'local_government_area' => ['required'],
            'organization' => ['required'],
            'office_address' => ['required'], 
            'property_type' => ['required'], 
        ]);

        if ($validator->fails()) {
            return back()
            ->withInput()
            ->withErrors($validator);
        }

        else{
            $name = $request->input('name');
            $surname = $request->input('surname');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $date_of_birth = $request->input('date_of_birth');
            $gender = $request->input('gender');
            $marital_status = $request->input('marital_status');
            $state= $request->input('state');
            $country= $request->input('country');
            $residential = $request->input('residential');
            $local_government_area = $request->input('local_government_area');
            $organization = $request->input('organization');
            $office_address = $request->input('office_address');
            $property_type = $request->input('property_type');

            $data=array(
                'name'=>$name,
                'surname'=>$surname ,
                'phone'=>$phone,
                'email'=>$email,
                'DOB'=>$date_of_birth,
                'gender'=>$gender,
                'marital_status'=>$marital_status,
                'residential_address'=>$residential,
                'state'=>$state,
                'country'=>$country,
                'LGA'=>$local_government_area,
                'organisation'=>$organization,
                'office_address'=>$office_address,
                'property_type'=>$property_type,

            );
            $submit= DB::table('applications')->insert($data);

            if ($submit) {
                return back()->with('success', 'Sumission successful');

            }

            else{
                return back()->with('error', 'Submission Failed. please try Again.');
            }
        }
    }
}
