<?php

namespace App\Http\Controllers;

use App\Models\MeetingModel;
use App\Models\Participent;
use App\Models\PollModel;
use App\Models\PollOptionModel;
use App\Models\QNAModel;
use App\Models\UserPollModel;
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

        $full_name = $request->firstname . " " . $request->lastname;

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


        if ($user)
            $request->session()->flash('success', 'User registered successfully!');
        else
            $request->session()->flash('fail', 'User not registered!');

        return redirect()->route('home');
    }

    public function user_login()
    {
        return view('users.login');
    }

    public function user_validate(Request $request)
    {

        $user = Auth::guard('webuser')->attempt(['phone' => $request->phone, 'password' => $request->password]);

        $record = Auth::guard('webuser')->user();

        if ($user && $record->status == 1) {

            $request->session()->put('webuser', Auth::guard('webuser')->user());
            
            if ($record->login_status == null) {
                
                return redirect()->route('user-upadtepassword');

            } else {
               
                return redirect()->route('user-dashboard');
            }
        }

        $request->session()->flash('fail', 'Unable to login!');
        return redirect()->route('user-login');
    }

    public function dashboard()
    {
        $phone = Auth::guard('webuser')->user()->phone;
        $meeting_ids = WebUser::where('phone', $phone)->get()->pluck('meeting_id')->toArray();
        $meetings = MeetingModel::whereIn('meeting_number', $meeting_ids)->get();


        return view('users.dashboard', compact('meetings'));
    }

    public function join_meeting($meeting_id)
    {
        $meeting = MeetingModel::where('meeting_number', $meeting_id)->first();
        $meeting_polls = PollModel::where('meeting_number', $meeting_id)->get();
        return view('users.join_meeting', compact('meeting', 'meeting_polls'));
    }

    public function update_participant_status($status, $id)
    {
        $new_status = (-$status) + (1);
        Participent::where(['id' => $id])->update(["status" => $new_status]);
        return redirect()->back();
    }

    public function update_participant_password($id)
    {
        $password = bcrypt("123456");
        Participent::where(['id' => $id])->update(["password" => $password, 'login_status' => null]);
        return redirect()->back();
    }
    public function upadtepassword()
    {
        return view('users.updatepassword');
    }

    public function change_password(Request $request)
    {
        $id = $request->id;
        $password = $request->password;

        WebUser::where('id',$id)->update(['password'=>bcrypt($password),'login_status'=>1]);
        
        return redirect()->route('user-dashboard');
    }

    public function user_poll_submission(Request $request)
    {
        foreach ($request->questions as $q) {
            // Insert into user_polls table
            UserPollModel::create([
                'paticipant_id' => $request->participant_id,
                'question_id'   => $q['question_id'],
                'option_id'     => $q['option_id'],
            ]);

            // Update vote count in options table
            PollOptionModel::where('id', $q['option_id'])->increment('votes_count');
        }
        return response(['message' => 'success'], 200);
    }




    public function poll_list(Request $request)
    {
        // $polls = PollModel::get();
        // return view('users.poll-list', compact('polls'))->render();

        $participant_id = $request->session()->get('webuser')->id; 
        
    // Get IDs of questions answered by the user
    $answeredQuestionIds = UserPollModel::where('paticipant_id', $participant_id)
        ->pluck('question_id')
        ->toArray();

    // Get polls where at least one question has NOT been answered by the user
    $polls = PollModel::whereHas('questions', function ($query) use ($answeredQuestionIds) {
            if (!empty($answeredQuestionIds)) {
                $query->whereNotIn('id', $answeredQuestionIds);
            }
        })
        ->with('questions.options') // Optional: preload questions/options
        ->get();

    return view('users.poll-list', compact('polls'))->render();

    }

    public function qna_list($ask_by)
    {
        $qna_list  =QNAModel::where('ask_by',$ask_by)->get();
        return view('users.qna-list', compact('qna_list'))->render();
        
    }

}
