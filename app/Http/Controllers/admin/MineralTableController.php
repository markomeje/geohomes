<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;

class MineralTableController extends Controller
{
//
  public function admin()
  {
    $fetch = DB::table('mineral')->paginate(8);
    $mineral = json_decode(json_encode($fetch ), true);
    return view('admin.mineral-table', ['mineral'=>$fetch ]);
  }

  public function delete($id) {

      if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');
  }
    $delet=DB::delete('delete from mineral where id = ?',[$id]);

    if ($delet) {
      return back()->with('success', 'Record deleted successfully');

    }

    else{
      return back()->with('error', 'Record was not deleted. please try Again.');
    }
  }

  /* Code for inserting data into the database */
  public function addMineralForm()
  {
      if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');
  }
    return view('admin.addmineral');
  }

  public function MineralInsert(Request $request)
  {
      if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');
  }
    $data = request()->all();
    $validator = Validator::make($data, [  
      'title' => ['required'],
      'description' => ['required'],
      'first_image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
      'second_image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
      'third_image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => 0,
        'error' => $validator->errors()
      ]);
    }

    $firstimage = request()->file('first_image');
    $secondimage = request()->file('second_image');
    $thirdimage = request()->file('third_image');


    $extension = $firstimage->getClientOriginalExtension();
    $firstfilename = Str::uuid().'.'.$extension;
    $path = 'assets/upload/mineral_images';
    $firstimage->move($path, $firstfilename);

    $extension = $secondimage->getClientOriginalExtension();
    $secondfilename = Str::uuid().'.'.$extension;
    $path = 'assets/upload/mineral_images';
    $secondimage->move($path, $secondfilename);

    $extension = $secondimage->getClientOriginalExtension();
    $thirdfilename = Str::uuid().'.'.$extension;
    $path = 'assets/upload/mineral_images';
    $thirdimage->move($path, $thirdfilename);

    $request=array([
      'title' => $request['title'],
      'description' => $request['description'],
'first_image' => $firstfilename, // save full image path to database
'second_image' => $secondfilename, // save full image path to database
'third_image' => $thirdfilename, // save full image path to database
]);

    $submit= DB::table('mineral')->insert($request);

    if ($submit) {
      return back()->with('success', 'You have successfully Added Content. Thank You.');

    }

    else{
      return back()->with('error', 'Mineral services was not Added. Please try Again.');
    }
  }

// Viewing of page detail
  public function viewMineral($id)
  {
      if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');
  }
    $fetch = DB::table('mineral')
    ->where('id', $id)
    ->get();
    $mineral= json_decode(json_encode($fetch ), true);
    return view('admin.view.view_mineral', ['mineral'=>$mineral]);
  }
  

  /* For Editing Mineral Table In the DataBase */

  public function editForm($id)
  {
      if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');
  }

    $fetch = DB::table('mineral')
    ->where('id', $id)
    ->get();
    $mineral= json_decode(json_encode($fetch ), true);
    return view('admin.edit.mineraledit', ['mineral'=>$mineral]);
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
      'first_image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
      'second_image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
      'third_image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],

    ]);


    if ($validator->fails()) {
      return response()->json([
        'status' => 0,
        'error' => $validator->errors()
      ]);
    }

    else{

      $firstimage = request()->file('first_image');
      $secondimage = request()->file('second_image');
      $thirdimage = request()->file('third_image');

      $extension = $firstimage->getClientOriginalExtension();
      $firstfilename = Str::uuid().'.'.$extension;
      $path = 'assets/upload/mineral_images';
      $firstimage->move($path, $firstfilename);

      $extension = $secondimage->getClientOriginalExtension();
      $secondfilename = Str::uuid().'.'.$extension;
      $path = 'assets/upload/mineral_images';
      $secondimage->move($path, $secondfilename);

      $extension = $thirdimage->getClientOriginalExtension();
      $thirdfilename = Str::uuid().'.'.$extension;
      $path = 'assets/upload/mineral_images';
      $thirdimage->move($path, $thirdfilename);


      $title = $request->input('title');
      $description = $request->input('description');
      $id = $request->input('id');

      $edit=DB::table('mineral')
      ->where('id', $id)
      ->update([
        'title' => "$title",
        'description' => "$description",
        'first_image' => "$firstfilename",
        'second_image' => "$secondfilename",
        'third_image' => "$thirdfilename",
      ]);


      if ($edit) {
        return back()->with('success', 'Record Updated successfully');

      }

      else{
        return back()->with('error', 'Record was not Updated. please try Again.');
      }
    }
  }
}
