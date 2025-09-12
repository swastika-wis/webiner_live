<?php

namespace App\Http\Controllers;

use App\Models\MeetingModel;
use App\Models\PollModel;
use App\Models\PollOptionModel;
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
            $user=Auth::guard('vendoruser')->user();
            $request->session()->put('vendoruser',$user);
            return redirect()->route('vendor-dashboard');            
        }
        $request->session()->flash('fail','Unable to login!');
        return redirect()->back();
    }

    public function dashboard()
    {
        $vendor_id = Auth::guard('vendoruser')->user()->id;
        $meetings = MeetingModel::where('vendor_id',$vendor_id)->get();
        return view('vendor.dashboard',compact('meetings'));
    }

    public function vendor_poll_submission(Request $request)
    {          
        // store poll question 
        $quetion_record = new PollModel();
        $quetion_record->meeting_number=$request->meeting_id;
        $quetion_record->question=$request->question;
        $quetion_record->save();


        // store poll option 
        foreach($request->polloption as $option)
        {

            $option_record = new PollOptionModel();
            $option_record->poll_id=$quetion_record->id;
            $option_record->option=$option;
            $option_record->save();
        }

        return response([
            'message'=>'success'
        ],200);

    }

    public function vendor_poll_list(Request $request,$meeting_number)
    {   
        $poll_lists = PollModel::where('meeting_number',$meeting_number)->get();
        $data='<table class="table table-responsive">
        <thead>
            <tr>
                <th>Question</th>
                <th>Options</th>
                <th>Value</th>
                
            </tr>
        </thead>
        <tbody>';
            
        
        foreach($poll_lists as $poll)
        {
            $data.='<tr>
                <td>'.$poll->question.'</td>';

            $data.='<td><ul>';
            foreach($poll->options as $option)
            {
                $data.='<li>'.$option->option.'</li>';
                
            }
            $data.='</ul></td><td><ul>';

            foreach($poll->options as $option)
            {
                $data.='<li>'.$option->votes_count.'</li>';
            }


            $data.='</ul></td></tr>';
        }

        $data.='</tbody>
        </table>';

        return response([
            'message'=>'success',
            'data'=>$data

        ],200);
    }

}
