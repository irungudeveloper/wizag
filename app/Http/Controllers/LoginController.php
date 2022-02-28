<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function login(Request $request)
    {
        $validate = $request->validate([
                                        'email' => ['required', 'email'],
                                        'password' => ['required'],
                                      ]);
 
        if (Auth::attempt($validate)) 
        {
            $request->session()->regenerate();
 
            if(Auth::user()->role_id == 1)
            {
                return redirect('dshboard.index');
            }
            else
            {  
                $quote = Http::get('https://api.kanye.rest/');

                return redirect('dashboard.index')->with('quote',$quote);
            }
        }
       
        return back()->with('errors','Wrong Credentials Provided');

    }
}
