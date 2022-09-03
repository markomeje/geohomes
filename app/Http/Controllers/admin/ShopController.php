<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;

class ShopController extends Controller
{
// fetching data from database
    public function admin()
    {
        $fetch = DB::table('portifolio')->paginate(6);
        $portifolio = json_decode(json_encode($fetch ), true);
        return view('admin.portifolio_table', ['portifolio'=>$fetch]);
    }


// delete function
    public function delete($id) {
        
        if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');
  }
        $delet=DB::delete('delete from portifolio where id = ?',[$id]);

        if ($delet) {
            return back()->with('success', 'Record deleted successfully');

        }

        else{
            return back()->with('error', 'Record was not deleted. please try Again.');
        }
    }

    /* Add Data To Portifolio Or SHOP Table in the Database */

    public function addShopForm()
    {
         if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');
  }
        return view('admin.add_portifolio');
    }

    public function ShopInsert(Request $request)
    {
         if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');
  }

        $data = request()->all();
        $validator = Validator::make($data, [  
            'title' => ['required'],
            'location' => ['required'],
            'product' => ['required'],
            'price' => ['required'],
            'feature' => ['required'],
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $image = request()->file('image');


        $extension = $image->getClientOriginalExtension();
        $filename = Str::uuid().'.'.$extension;
        $path = 'assets/upload/portifolio_images';
        $image->move($path, $filename);



        $request=array([
            'title' => $request['title'],
            'location' => $request['location'],
            'product' => $request['product'],
            'price' => $request['price'],
            'features' => $request['feature'],
'image' => $filename, // save full image path to database
]);

        $submit= DB::table('portifolio')->insert($request);

        if ($submit) {
            return back()->with('success', 'You have successfully Added Portifolio. Thank You.');

        }

        else{
            return back()->with('error', 'Portifolio was not Added. Please try Again.');
        }
    }
    
   public function viewShop($id)
    {
         if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');
  }
        $fetch = DB::table('portifolio')
        ->where('id', $id)
        ->get();
        $portifolio = json_decode(json_encode($fetch ), true);
        return view('admin.view.view_portifolio', ['portifolio'=>$portifolio]);
    }

    /* For Editing Shop or portifolio Table in the Database */

    public function editForm($id)
    {       
         if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');
  }
        $fetch = DB::table('portifolio')
        ->where('id', $id)
        ->get();
        $portifolio = json_decode(json_encode($fetch ), true);
        return view('admin.edit.editportifolio', ['portifolio'=>$fetch]);
    }


    public function Edit(Request $request) {
    if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');
  }
        $data = request()->all();
        $validator = Validator::make($data, [ 
            'title' => ['required'],
            'location' => ['required'],
            'price' => ['required'], 
            'product' => ['required'],
            'description' => ['required'],
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240'],

        ]);


        if ($validator->fails()) {
            return back()->with('the Field is empty.');
        }

        else{
            $image = request()->file('image');

            $extension = $image->getClientOriginalExtension();
            $filename = Str::uuid().'.'.$extension;
            $path = 'assets/upload/portifolio_images';
            $image->move($path, $filename);


            $title = $request->input('title');
            $location = $request->input('location');
            $product = $request->input('product');
            $price = $request->input('price');
            $description = $request->input('description');
            $id = $request->input('id');


            $edit=DB::table('portifolio')
            ->where('id', $id)
            ->update([
                'title' => "$title",
                'location' => "$location",
                'product' => "$product",
                'price' => "$price",
                'features' => "$description",
                'image' => "$filename",]);


            if ($edit) {
                return back()->with('success', 'Record Updated successfully');

            }

            else{
                return back()->with('error', 'Record was not Updated. please try Again.');
            }
        }
    }
}
