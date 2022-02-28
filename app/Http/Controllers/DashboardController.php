<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Auth;

class DashboardController extends Controller
{
    //This controller returns the appropriate dashboard to be viewed upon login

    public function index()
    {
        // code...
        return view('master');
    }
}
