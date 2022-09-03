<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;

class MedicalTableController extends Controller
{
//
  public function admin()
  {
    $fetch = DB::table('medicals')->paginate(8);
    $medical = json_decode(json_encode($fetch ), true);
    return view('admin.medical-table', ['medical'=>$fetch]);
  }

  public function delete($id) {

     if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');

  }
    $delet=DB::delete('delete from medicals where id = ?',[$id]);

    if ($delet) {
      return back()->with('success', 'Record deleted successfully');

    }

    else{
      return back()->with('error', 'Record was not deleted. please try Again.');
    }
  }
  /* this code belows shows add medical form and submit data to the database */
  public function addMedicalForm()
  {
     if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }
    return view('admin.addmedical');
  }

  public function MedicalInsert(Request $request)
  {
     if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }

    $data = request()->all();
    $validator = Validator::make($data, [  
      'title' => ['required'],
      'description' => ['required'],
      'image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],

    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => 0,
        'error' => $validator->errors()
      ]);
    }

    $firstimage = request()->file('image');


    $extension = $firstimage->getClientOriginalExtension();
    $firstfilename = Str::uuid().'.'.$extension;
    $path = 'assets/upload/medical_images';
    $firstimage->move($path, $firstfilename);



    $request=array([
      'title' => $request['title'],
      'description' => $request['description'],
'image' => $firstfilename, // save full image path to database

]);

    $submit= DB::table('medicals')->insert($request);

    if ($submit) {
      return back()->with('success', 'You have successfully Added content. Thank You.');

    }

    else{
      return back()->with('error', 'content was not Added. Please try Again.');
    }
  }
  /* For Viewing Medical page */
   public function viewMedical($id)
  {
     if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');
  }
    $fetch = DB::table('medicals')
    ->where('id', $id)
    ->get();
    $medical= json_decode(json_encode($fetch ), true);
    return view('admin.view.view_medical', ['medical'=>$medical]);
  }


  /* Form Editing Medical Table in Database */

  public function editForm($id)
  {
     if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }
    $fetch = DB::table('medicals')
    ->where('id', $id)
    ->get();
    $medical= json_decode(json_encode($fetch ), true);
    return view('admin.edit.medicaledit', ['medical'=>$medical]);
  }



  public function Edit(Request $request)
  {
     if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }
    $data = request()->all();
    $validator = Validator::make($data, [ 
      'title' => ['required'], 
      'description' => ['required'], 
      'image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],

    ]);


    if ($validator->fails()) {
      return response()->json([
        'status' => 0,
        'error' => $validator->errors()
      ]);
    }

    else{

      $image = request()->file('image');

      $extension = $image->getClientOriginalExtension();
      $filename = Str::uuid().'.'.$extension;
      $path = 'assets/upload/medical_images';
      $image->move($path, $filename);




      $title = $request->input('title');
      $description = $request->input('description');
      $id = $request->input('id');

      $edit=DB::table('medicals')
      ->where('id', $id)
      ->update([
        'title' => "$title",
        'description' => "$description",
        'image' => "$filename",

      ]);


      if ($edit) {
        return back()->with('success', 'Record Updated successfully. Check the Services Table');

      }

      else{
        return back()->with('error', 'Record was not Updated. please try Again.');
      }
    }
  }

}
