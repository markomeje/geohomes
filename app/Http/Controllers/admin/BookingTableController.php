<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Validator;
use Str;

class BookingTableController extends Controller
{
//
    public function admin()
    {
        $fetch = DB::table('bookings')->get();
        $array = json_decode(json_encode($fetch ), true);
        return view('admin.booking_table', ['array'=>$array]);
    }

    public function delete($id) {
         if (Gate::denies('delete')) {
    return back()->with('error', 'Access Denied.');

  }
        $delet=DB::delete('delete from bookings where id = ?',[$id]);

        if ($delet) {
            return back()->with('success', 'Record deleted successfully');

        }

        else{
            return back()->with('error', 'Record was not deleted. please try Again.');
        }
    }

    /* For Inserting Booking Form into Database */
    public function BookingForm()
    {    if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }
        return view('admin.bookinspection');
    }


    /* for Booking form submission */

    public function InsertBookingForm(Request $request){
         if (Gate::denies('create')) {
    return back()->with('error', 'Access Denied.');

  }
        $data = request()->all();
        $validator = Validator::make($data, [  
            'name' => ['required'],
            'middlename' => ['required'],
            'surname' => ['required'],
            'phone' => ['required'],
            'email' => ['required','email'],
            'residential' => ['required'],
            'office' => ['required'],
            'desired_service' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()
            ->withInput()
            ->withErrors($validator);
        }

        else{

            $firstname = $request->input('name');
            $miidlename = $request->input('middlename');
            $surname = $request->input('surname');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $residential_address = $request->input('residential');
            $office_address = $request->input('office');
            $desired_service = $request->input('desired_service');


            $data=array(
                'firstname'=>$firstname,
                'middlename'=>$miidlename,
                'surname'=>$surname,
                'phone'=>$phone,
                'email'=>$email,
                'residential_address'=>$residential_address,
                'office_address'=>$office_address,
                'desired_service'=>$desired_service,

            );
            $submit= DB::table('bookings')->insert($data);

            if ($submit) {
                return back()->with('success', 'Sumission successful');

            }

            else{
                return back()->with('error', 'Submission Failed. please try Again.');
            }
        }
    }

    /* For Editing Booking Form*/

    public function editForm($id)
    {
         if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

         }
        $fetch = DB::table('bookings')
        ->where('id', $id)
        ->get();
        $booking = json_decode(json_encode($fetch ), true);
        return view('admin.edit.bookingformedit', ['booking'=>$booking]);
    }

    public function viewBooking($id)
    {
    if (Gate::denies('view')) {
    return back()->with('error', 'Access Denied.');
  }
        $fetch = DB::table('bookings')
        ->where('id', $id)
        ->get();
        $booking = json_decode(json_encode($fetch ), true);
        return view('admin.view.view_booking', ['booking'=>$booking]);
    }

    public function Edit(Request $request)
    {
    if (Gate::denies('update')) {
    return back()->with('error', 'Access Denied.');

  }

        $data = request()->all();
        $validator = Validator::make($data, [  
            'firstname' => ['required'],
            'middlename' => ['required'],
            'surname' => ['required'],
            'phone' => ['required'],
            'email' => ['required','email'],
            'residential' => ['required'],
            'office' => ['required'],
            'desired_service' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()
            ->withInput()
            ->withErrors($validator);
        }

        else{

            $firstname = $request->input('firstname');
            $middlename = $request->input('middlename');
            $surname = $request->input('surname');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $residential = $request->input('residential');
            $office = $request->input('office');
            $desired_service= $request->input('desired_service');
            $id = $request->input('id');


            $edit=DB::table('bookings')
            ->where('id', $id)
            ->update([
                'firstname' => "$firstname",
                'middlename' => "$middlename",
                'surname' => "$surname",
                'phone' => "$phone",
                'email' => "$email",
                'residential_address' => "$residential",
                'office_address' => "$office",
                'desired_service' => "$desired_service",]);



            if ($edit) {
                return back()->with('success', 'Record Updated successfully');

            }

            else{
                return back()->with('error', 'Record was not Updated. please try Again.');
            }
        }
    }

}
