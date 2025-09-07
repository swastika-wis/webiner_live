<?php

namespace App\Http\Controllers;

use App\Models\WebUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebUserController extends Controller
{
    /**
     * Store a newly registered user.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'firstname' => 'required|string|max:145',
        //     'lastname'  => 'nullable|string|max:145',
        //     'emailid'   => 'required|email|max:100|unique:web_users,emailid',
        //     'phone'     => 'required|string|max:45',
        //     'city'      => 'nullable|string|max:100',
        //     'refid'     => 'nullable|integer',
        //     'financialAdvisor'     => 'nullable|string|max:45',
        //     'financialAdisorname'  => 'nullable|string|max:145',
        //     'financialAdisorarn'   => 'nullable|string|max:145',
        // ]);

        $full_name = $request->firstname." ". $request->lastname;

        $user = WebUser::create([
            'firstname' => $full_name,            
            'emailid'   => $request->emailid,
            'phone'     => $request->phone,
            'city'      => $request->city,
            'refid'     => $request->refid,
            'createdate'          => now(),
        ]);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'User registered successfully!',
        //     'data'    => $user
        // ]);


        if($user)
            $request->session()->flash('success','User registered successfully!');
        else 
            $request->session()->flash('fail','User not registered!');

        return redirect()->route('home');

    }

    
}
