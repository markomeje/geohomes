<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;

class AgricultureTableController extends Controller
{
//
  public function admin()
  {
    $fetch = DB::table('agriculture')->paginate(8);
    $agriculture = json_decode(json_encode($fetch ), true);
    return view('admin.agriculture-table', ['agriculture'=>$fetch]);
  }


  public function delete($id) {
  if (Gate::denies('delete')) {
    return back()->with('error', 'Sorry, You can not Edit this page');

  }

    $delet=DB::delete('delete from agriculture where id = ?',[$id]);

    if ($delet) {
      return back()->with('success', 'Record deleted successfully');

    }

    else{
      return back()->with('error', 'Record was not deleted. please try Again.');
    }
  }

  /* For inserting data into agriculture table */

  public function addAgricultureForm()
  {
     if (Gate::denies('create')) {
    return back()->with('error', 'Sorry, You can not Edit this page');

  }
    return view('admin.addagriculture');
  }

  public function AgricultureInsert(Request $request)
  {
   if (Gate::denies('create')) {
    return back()->with('error', 'Sorry, You can not Edit this page');

  }


    $data = request()->all();
    $validator = Validator::make($data, [  
      'title' => ['required'],
      'description' => ['required'],
      'first_image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
      'second_image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => 0,
        'error' => $validator->errors()
      ]);
    }

    $firstimage = request()->file('first_image');
    $secondimage = request()->file('second_image');


    $extension = $firstimage->getClientOriginalExtension();
    $firstfilename = Str::uuid().'.'.$extension;
    $path = 'assets/upload/agriculture_images';
    $firstimage->move($path, $firstfilename);

    $extension = $secondimage->getClientOriginalExtension();
    $secondfilename = Str::uuid().'.'.$extension;
    $path = 'assets/upload/agriculture_images';
    $secondimage->move($path, $secondfilename);

    $request=array([
      'title' => $request['title'],
      'description' => $request['description'],
'first_image' => $firstfilename, // save full image path to database
'second_image' => $secondfilename, // save full image path to database
]);

    $submit= DB::table('agriculture')->insert($request);

    if ($submit) {
      return back()->with('success', 'You have successfully Added Content. Thank You.');

    }

    else{
      return back()->with('error', 'Mineral services was not Added. Please try Again.');
    }
  }

  /* This code handles the editing of Agriculture Page */
  public function editForm($id)
  {
    {
   if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }
    $fetch = DB::table('agriculture')
    ->where('id', $id)
    ->get();
    $agriculture= json_decode(json_encode($fetch ), true);
    return view('admin.edit.agricultureedit', ['agriculture'=>$agriculture]);
  }

  public function viewAgriculture($id)
  {
    if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');

  }
    $fetch = DB::table('agriculture')
    ->where('id', $id)
    ->get();
    $agriculture= json_decode(json_encode($fetch ), true);
    return view('admin.view.view_agriculture', ['agriculture'=>$agriculture]);
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

      $extension = $firstimage->getClientOriginalExtension();
      $firstfilename = Str::uuid().'.'.$extension;
      $path = 'assets/upload/agriculture_images';
      $firstimage->move($path, $firstfilename);

      $extension = $secondimage->getClientOriginalExtension();
      $secondfilename = Str::uuid().'.'.$extension;
      $path = 'assets/upload/agriculture_images';
      $secondimage->move($path, $secondfilename);



      $title = $request->input('title');
      $description = $request->input('description');
      $id = $request->input('id');

    /* delete the image before uploading new one */
Storage::disk('s3')->delete('/public/assets/agriculture_images'.['first_image', 'second_image']);

      $edit=DB::table('agriculture')
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
