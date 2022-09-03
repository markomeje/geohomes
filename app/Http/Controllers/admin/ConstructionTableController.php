<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;
class ConstructionTableController extends Controller
{
//

  public function admin()
  {
    $fetch = DB::table('construction')->paginate(8);
    $construction = json_decode(json_encode($fetch ), true);
    return view('admin.construction_table', ['construction'=>$fetch]);
  }

  public function delete($id) {
          if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');

  }


    $delet=DB::delete('delete from construction where id = ?',[$id]);

    if ($delet) {
      return back()->with('success', 'Record deleted successfully');

    }

    else{
      return back()->with('error', 'Record was not deleted. please try Again.');
    }
  }

  /* for adding construction */

  public function addConstructionForm()
  {
          if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }

    return view('admin.add_construction');
  }

  public function ConstructionInsert(Request $request)
  {
          if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }

    $data = request()->all();
    $validator = Validator::make($data, [ 
      'title' => ['required'], 
      'description' => ['required'], 
      'firstimage' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
      'secondimage' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],

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
    $path = 'assets/upload/construction_images';
    $firstimage->move($path, $firstfilename);

    $extension = $secondimage->getClientOriginalExtension();
    $secondfilename = Str::uuid().'.'.$extension;
    $path = 'assets/upload/construction_images';
    $secondimage->move($path, $secondfilename);


    $request=array([
      'title' => $request['title'],
      'description' => $request['description'],
'first_image' => $firstfilename, // save full image path to database
'second_image' => $secondfilename, // save full image path to database
]);

    $submit= DB::table('construction')->insert($request);

    if ($submit) {
      return back()->with('success', 'content added Successfully.');

    }

    else{
      return back()->with('error', 'Sorry, Content was not Added. Please try Again.');
    }
  }
/* Viewing of Construction Form */
 public function viewConstruction($id)
  {
          if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');

  }

    $fetch = DB::table('construction')
    ->where('id', $id)
    ->get();
    $construction = json_decode(json_encode($fetch ), true);
    return view('admin.view.view_construction', ['construction'=>$construction]);
  }

  
  /* For Editing Construction Table */
  public function editForm($id)
  {
          if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }

    $fetch = DB::table('construction')
    ->where('id', $id)
    ->get();
    $construction = json_decode(json_encode($fetch ), true);
    return view('admin.edit.constructionedit', ['construction'=>$construction]);
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

      $title = $request->input('title');
      $description = $request->input('description');
      $id = $request->input('id');

      $firstimage = request()->file('firstimage');
      $secondimage = request()->file('secondimage');

      $extension = $firstimage->getClientOriginalExtension();
      $firstfilename = Str::uuid().'.'.$extension;
      $path = 'assets/upload/construction_images';
      $firstimage->move($path, $firstfilename);

      $extension = $secondimage->getClientOriginalExtension();
      $secondfilename = Str::uuid().'.'.$extension;
      $path = 'assets/upload/construction_images';
      $secondimage->move($path, $secondfilename);



      $edit=DB::table('construction')
      ->where('id', $id)
      ->update([
        'title' => "$title",
        'description' => "$description",
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
}
