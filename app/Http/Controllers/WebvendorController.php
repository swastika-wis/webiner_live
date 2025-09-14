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
    public function vendor_login($vendor_id = 0)
    {
        $id = Crypt::decrypt($vendor_id);
        $vendor = null;

        $vendors = Vendor::get();

        if ($id != 0) {
            $vendor = Vendor::where('id', $id)->first();
        }

        return view('vendor.login', compact('vendor_id', 'vendor', 'vendors'));
    }

    public function vendor_validate(Request $request)
    {
        $auth = Auth::guard('vendoruser')->attempt(['user_name' => $request->email, 'password' => $request->password]);
        if ($auth) {
            $user = Auth::guard('vendoruser')->user();
            $request->session()->put('vendoruser', $user);
            return redirect()->route('vendor-dashboard');
        }
        $request->session()->flash('fail', 'Unable to login!');
        return redirect()->back();
    }

    public function dashboard()
    {
        $vendor_id = Auth::guard('vendoruser')->user()->id;
        $meetings = MeetingModel::where('vendor_id', $vendor_id)->get();
        return view('vendor.dashboard', compact('meetings'));
    }




    public function vendor_poll_submission(Request $request)
    {

        
        // $request->validate([
        //     'title'      => 'required|string|max:255',
        //     'start_time' => 'nullable|date',
        //     'end_time'   => 'nullable|date|after_or_equal:start_time',
        //     'questions'  => 'required|array|min:1',
        // ]);


        // Create Poll
        $poll = PollModel::create([
            'meeting_number' => $request->meeting_id,
            'title'          => $request->title,
            'start_time'     => $request->start_time,
        ]);

        // 2. Create questions
        foreach ($request->questions as $qIndex => $qData) {
            $question = $poll->questions()->create([
                'question_type' => $qData['type'],
                'question_text' => $qData['text'] ?? null,
                'question_image' => $qData['image'] ?? null,
            ]);

            // 3. Create options
            if (!empty($qData['options'])) {
                foreach ($qData['options'] as $optionText) {
                    $question->options()->create([
                        'option_text' => $optionText,
                    ]);
                }
            }
        }

        return redirect()->route('vendor-poll-list');
    }

    public function vendor_poll_list(Request $request)
    {
        // $meeting_number = "";
        // $poll_lists = PollModel::where('meeting_number', $meeting_number)->get();
        // $data = '<table class="table table-responsive">
        // <thead>
        //     <tr>
        //         <th>Question</th>
        //         <th>Options</th>
        //         <th>Value</th>
                
        //     </tr>
        // </thead>
        // <tbody>';


        // foreach ($poll_lists as $poll) {
        //     $data .= '<tr>
        //         <td>' . $poll->question . '</td>';

        //     $data .= '<td><ul>';
        //     foreach ($poll->options as $option) {
        //         $data .= '<li>' . $option->option . '</li>';
        //     }
        //     $data .= '</ul></td><td><ul>';

        //     foreach ($poll->options as $option) {
        //         $data .= '<li>' . $option->votes_count . '</li>';
        //     }


        //     $data .= '</ul></td></tr>';
        // }

        // $data .= '</tbody>
        // </table>';

        // return response([
        //     'message'=>'success',
        //     'data'=>$data

        // ],200);

        $polls = PollModel::get();
        return view('vendor.vendor_poll_list',compact('polls'));

    }

    public function vendor_create_poll($meeting_id)
    {
        return view('vendor.vendor_create_poll', compact('meeting_id'));
    }
}
