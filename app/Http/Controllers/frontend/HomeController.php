<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use DB;

class HomeController extends Controller
{
   public function index()
    {
        SEOTools::setTitle('Home');
        SEOTools::setDescription('A private Limited liability company, duly registered under the Companies and Allied Matters Act of 1990 on 12th August. The Company is a firm of qualified, Experienced Estate Developers and Mangers, Civil Engineers. The Company deals on constructions, Supply of Raw Materials, General Merchandise, and General Contracts.');
        SEOTools::opengraph()->setUrl(env('APP_URL'));
        SEOTools::setCanonical(env('APP_URL'));
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');
        return view('frontend.home');
    }

    /* news form submission */

    public function NewsInsert(Request $request){
        $email = $request->input('name');
         $data=array(
            'email'=>$email,

             );
            $submit= DB::table('newsletters')->insert($data);

        if ($submit) {
            back()->with('success', 'Subscription successful');

    }

       else{
        return back()->with('error', 'Subscription Failed. please try Again.');
       }
  }

  public function submitContact(Request $request)
   {

      $data = request()->all();
        $validator = Validator::make($data, [
             'name' => ['required'], 
            'email' => ['required', 'email'], 
            'message' => ['required'], 
           
        ]);
        dd($data);

          if ($validator->fails()) {
         return back()
         ->withInput()
         ->withErrors($validator);
        }


        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');
        $data=array(
            'name'=>$name,
            'email'=>$email,
            'message'=>$message,
        );
            $submit= DB::table('contacts')->insert($data);

       if ($submit) {
            return back()->with('success', 'Your Message has been submitted. Thank You.');

    }

       else{
        return back()->with('error', 'message not sent. Please try Again.');
       }
   
  }

}