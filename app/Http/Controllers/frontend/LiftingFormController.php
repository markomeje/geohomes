<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LiftingFormController extends Controller
{
     public function index()
    {
        return view('frontend.lifting-form');
    }
}
