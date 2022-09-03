<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;

class EstateTableController extends Controller
{
//

    public function admin()
    {
        $fetch = DB::table('estate')->paginate(8);
        $estate = json_decode(json_encode($fetch ), true);
        return view('admin.estate_table', ['estate'=> $fetch]);
    }

    public function delete($id) {

        if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');

  }

        $delet=DB::delete('delete from estate where id = ?',[$id]);

        if ($delet) {
            return back()->with('success', 'Record deleted successfully');

        }

        else{
            return back()->with('error', 'Record was not deleted. please try Again.');
        }
    }

    /* For Adding Estate */

    public function addEstateForm()
    {
        if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }

        return view('admin.add_estate');
    }

    public function estateInsert(Request $request)
    {
        if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }

        $data = request()->all();
        $validator = Validator::make($data, [ 
            'title' => ['required'],
            'titledescription' => ['required'], 
            'firstdescription' => ['required'],
            'seconddescription' => ['required'],
            'thirddescription' => ['required'],
            'firstimage' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
            'secondimage' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
            'thirdimage' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $firstimage = request()->file('firstimage');
        $secondimage = request()->file('secondimage');
        $thirdimage = request()->file('thirdimage');

        $extension = $firstimage->getClientOriginalExtension();
        $firstfilename = Str::uuid().'.'.$extension;
        $path = 'assets/upload/estate_images';
        $firstimage->move($path, $firstfilename);

        $extension = $secondimage->getClientOriginalExtension();
        $secondfilename = Str::uuid().'.'.$extension;
        $path = 'assets/upload/estate_images';
        $secondimage->move($path, $secondfilename);

        $extension = $thirdimage->getClientOriginalExtension();
        $thirdfilename = Str::uuid().'.'.$extension;
        $path = 'assets/upload/estate_images';
        $thirdimage->move($path, $thirdfilename);


        $request=array([
            'title' => $request['title'],
            'titledescription' => $request['titledescription'],
            'first_description' => $request['firstdescription'],
            'second_description' => $request['seconddescription'],
            'third_description' => $request['thirddescription'],
'first_image' => $firstfilename, // save full image path to database
'second_image' => $secondfilename, // save full image path to database
'third_image' => $thirdfilename, // save full image path to database
]);

        $submit= DB::table('estate')->insert($request);

        if ($submit) {
            return back()->with('success', 'content added Successfully.');

        }

        else{
            return back()->with('error', 'Sorry, Content was not Added. Please try Again.');
        }
    }

    /* For Editing Estate */

    public function editForm($id)
    {
        if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }
        $fetch = DB::table('estate')
        ->where('id', $id)
        ->get();
        $estate = json_decode(json_encode($fetch ), true);
        return view('admin.edit.estateedit', ['estate'=>$estate]);
    }


    public function Edit(Request $request)
    {
        if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }
        $data = request()->all();
        $validator = Validator::make($data, [ 
            'title' => ['required'], 
            'titledescription' => ['required'], 
            'firstdescription' => ['required'],
            'seconddescription' => ['required'],
            'thirddescription' => ['required'],
            'firstimage' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
            'secondimage' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
            'thirdimage' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],

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
            $thirdimage = request()->file('thirdimage');

            $extension = $firstimage->getClientOriginalExtension();
            $firstfilename = Str::uuid().'.'.$extension;
            $path = 'assets/upload/estate_images';
            $firstimage->move($path, $firstfilename);

            $extension = $secondimage->getClientOriginalExtension();
            $secondfilename = Str::uuid().'.'.$extension;
            $path = 'assets/upload/estate_images';
            $secondimage->move($path, $secondfilename);

            $extension = $thirdimage->getClientOriginalExtension();
            $thirdfilename = Str::uuid().'.'.$extension;
            $path = 'assets/upload/estate_images';
            $thirdimage->move($path, $thirdfilename);


            $title = $request->input('title');
            $firstdescription = $request->input('firstdescription');
            $seconddescription = $request->input('seconddescription');
            $thirddescription = $request->input('thirddescription');
            $id = $request->input('id');

            $edit=DB::table('estate')
            ->where('id', $id)
            ->update([
                'title' => "$title",
                'titledescription' => "$firstdescription",
                'first_image' => "$firstfilename",
                'first_description' => "$firstdescription",
                'second_image' => "$secondfilename",
                'second_description' => "$seconddescription",
                'third_image' => "$thirdfilename",
                'third_description' => "$thirddescription",
            ]);


            if ($edit) {
                return back()->with('success', 'Record Updated successfully');

            }

            else{
                return back()->with('error', 'Record was not Updated. please try Again.');
            }
        }
    }
         /*View Estate Page */       
    public function viewEstate($id)
    {
        if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');

  }
        $fetch = DB::table('estate')
        ->where('id', $id)
        ->get();
        $estate = json_decode(json_encode($fetch ), true);
        return view('admin.view.view_estate', ['estate'=>$estate]);
    }
}
