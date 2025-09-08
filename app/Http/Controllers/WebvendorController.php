<?php

namespace App\Http\Controllers;

use App\Models\MeetingModel;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class WebvendorController extends Controller
{
    public function vendor_login($vendor_id=0)
    {
        $id = Crypt::decrypt($vendor_id);
        $vendor = null;

        $vendors = Vendor::get();

        
        if($id!=0)
        {
            $vendor = Vendor::where('id',$id)->first();
        }

        return view('vendor.login',compact('vendor_id','vendor','vendors'));
    }

    public function vendor_validate(Request $request)
    {
        $auth = Auth::guard('vendoruser')->attempt(['user_name'=>$request->email,'password'=>$request->password]);
        if($auth)
        {
            $request->session()->regenerate();
            return redirect()->route('vendor-dashboard');            
        }

        return redirect()->back();
    }

    public function dashboard()
    {
        $vendor_id = Auth::guard('vendoruser')->user()->id;
        $meetings = MeetingModel::where('vendor_id',$vendor_id)->get();
        return view('vendor.dashboard',compact('meetings'));
    }
}
