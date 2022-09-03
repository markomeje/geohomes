<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class Estate-detailController extends Controller
{
    public function index()
    {
        return view('estate-detail');
    }
}
