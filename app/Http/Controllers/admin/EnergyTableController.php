<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;

class EnergyTableController extends Controller
{
//

 public function admin()
 {
  $fetch = DB::table('energy')->get();
  $energy = json_decode(json_encode($fetch ), true);
  return view('admin.energy_table', ['energy'=>$fetch]);
 }

 public function delete($id) {

      if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');

  }
  $delet=DB::delete('delete from energy where id = ?',[$id]);

  if ($delet) {
   return back()->with('success', 'Record deleted successfully');

  }

  else{
   return back()->with('error', 'Record was not deleted. please try Again.');
  }
 }

 /* For Adding Energy */

 public function addEnergyForm()
 {
      if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }
  return view('admin.addenergy');
 }

 public function EnergyInsert(Request $request)
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
   'secondimage' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240']

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
  $path = 'assets/upload/energy_images';
  $firstimage->move($path, $firstfilename);

  $extension = $secondimage->getClientOriginalExtension();
  $secondfilename = Str::uuid().'.'.$extension;
  $path = 'assets/upload/energy_images';
  $secondimage->move($path, $secondfilename);


  $request=array([
   'title' => $request['title'],
   'first_description' => $request['firstdescription'],
   'second_description' => $request['seconddescription'],
'first_image' => $firstfilename, // save full image path to database
'second_image' => $secondfilename, // save full image path to database
]);

  $submit= DB::table('energy')->insert($request);

  if ($submit) {
   return back()->with('success', 'content added Successfully.');

  }

  else{
   return back()->with('error', 'Sorry, Content was not Added. Please try Again.');
  }
 }

 /* Energy Edit */

  public function editForm($id)
    {
          if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }
        $fetch = DB::table('energy')
        ->where('id', $id)
         ->get();
         $energy = json_decode(json_encode($fetch ), true);
        return view('admin.edit.energyedit', ['energy'=>$energy]);
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
        $path = 'assets/upload/energy_images';
        $firstimage->move($path, $firstfilename);

        $extension = $secondimage->getClientOriginalExtension();
        $secondfilename = Str::uuid().'.'.$extension;
        $path = 'assets/upload/energy_images';
        $secondimage->move($path, $secondfilename);



    $title = $request->input('title');
    $firstdescription = $request->input('firstdescription');
    $seconddescription = $request->input('seconddescription');
    $id = $request->input('id');

        $edit=DB::table('energy')
            ->where('id', $id)
            ->update([
                'title' => "$title",
                'first_description' => "$firstdescription",
                'second_description' => "$seconddescription",
                'first_image' => "$firstfilename",
                'second_image' => "$secondfilename",
                
            ]);


        if ($edit) {
                return back()->with('success', 'Record Updated successfully');

        }

           else{
            return back()->with('error', 'Record was not Updated. please try Again.');
           }
    }
 }
 
         public function viewEnergy($id)
    {
          if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');

  }
        $fetch = DB::table('energy')
        ->where('id', $id)
         ->get();
         $energy = json_decode(json_encode($fetch ), true);
        return view('admin.view.view_energy', ['energy'=>$energy]);
    }

}
