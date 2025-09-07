<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WebUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $auth = Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
        if($auth)
        {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        
        $request->session()->flash('fail','Unable to login!');
        return redirect()->route('index');
        
    }
    public function dashboard()
    {
        $leads=[];
        return view('admin.dashboard',compact('leads'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flash('success','Logout successful!');
        return redirect()->route('index');
    }
}
