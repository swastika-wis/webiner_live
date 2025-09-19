<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\MeetingModel;
use App\Models\Participent;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Services\ZoomService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ParticipantRequest;

class MeetingController extends Controller
{
    protected $zoomService;

    public function __construct(ZoomService $zoomService)
    {
        $this->zoomService = $zoomService;
    }

    public function index($type)
    {
        // $db_meetings = MeetingModel::get()->pluck('meeting_number')->toArray();
        // $vendor_meetings = MeetingModel::get()->pluck('vendor_id','meeting_number')->toArray();
        
        $meetings = MeetingModel::get();
        return view('admin.zoom_meetings', ['meetings' => $meetings]);
        //$meetings = $this->zoomService->listOfAllMeeting($type); 
        //return view('admin.zoom_meetings', ['meetings' => $meetings],compact('db_meetings','vendor_meetings'));
    }

    public function create(Request $request)
    {
        $vendors = Vendor::get();
        return view('admin.create_meeting',compact('vendors'));
    }


    public function store_meeting_url(Request $request)
    {
        

        $meeting_reocrd=new MeetingModel();

        $meeting_reocrd->save();
        
        $type="upcoming";
        return redirect()->route('meeting',['type' => $type]);

    }

    public function store(Request $request)
    {
        
        $meeting=null;
        $parameters=[];
        if($request->meeting_url){
            $link = explode("/",$request->meeting_url);
            $parameters = explode("?pwd=",$link[4]);

        }else{

            $meetingData = [
                'topic' => $request->topic,
                'type' => 2, // Scheduled meeting
                //'start_time' => now()->addHour()->toIso8601String(),
                'start_time' => Carbon::parse($request->start_time)->toIso8601String(),
                'duration' => $request->duration,
                'timezone' => 'Asia/Kolkata',
                'settings'   => [
                    'host_video'        => true,
                    'participant_video' => true,
                    'join_before_host'  => false,
                    'mute_upon_entry'   => true,
                    'approval_type'     => 1, // 1 for manual approval, 2 for automatic approval
                    'registration_type' => 1, // 1 for "register once"
                ]
            ];

            $meeting = $this->zoomService->createMeeting($meetingData);        
            $type="upcoming";
        }
    
        
        $type="upcoming";
        $meeting_reocrd=new MeetingModel();
        $meeting_reocrd->vendor_id=$request->meeting_vendor;
        $meeting_reocrd->topic=$request->topic;

        if($request->meeting_url)
            $meeting_reocrd->meeting_number=$parameters[0];
        else 
            $meeting_reocrd->meeting_number=$meeting['id'];


        $meeting_reocrd->meeting_details=response()->json($meeting);
        $meeting_reocrd->meeting_password=$parameters[1]??$meeting["encrypted_password"];
        $meeting_reocrd->created_at=$request->start_time;
        $meeting_reocrd->save();
        //return response()->json($meeting);
        return redirect()->route('meeting',['type' => $type]);
    }

    public function register_user(Request $request,$meeting_id)
    {
        //$record=MeetingModel::where('meeting_number',Crypt::decrypt($meeting_id))->first();
        $record=MeetingModel::where('meeting_number',$meeting_id)->first();
        return view("admin.register_user",compact('meeting_id','record'));
    }

    public function store_participent(ParticipantRequest $request)
    {
        // check user already registered or not?
        $record = Participent::where('phone',$request->phone)->where('meeting_id',$request->meeting_id)->first();
        if($record)
        {
            $request->session()->flash('You are already registerd! Please login with your phone number.');
            return redirect()->route('user-login');
        }
        else {

            $record = new Participent();
            $record->full_name=$request->name;
            $record->company_name = $request->company_name;
            $record->designation = $request->designation;
            $record->designation = $request->designation;            
            $record->email=$request->email;
            $record->phone=$request->phone;
            $record->field=$request->field;
            $record->meeting_id=$request->meeting_id;
            $record->password=bcrypt($request->password);
            $record->reference=$request->refer;
            $record->save();

            $subject="Confirm Your Registration";
            $view="emails.registraion";
            $body=["user_name"=>$record->full_name,"user_id"=>$record->id,"meeting_id"=>$request->meeting_id];
            Mail::to($request->email)->send(new SendEmail($subject,$view,$body));

            $request->session()->flash('success','Registration success!');
            return redirect()->route('user-login', ['meeting_number' => $request->meeting_id]);

        }

    }

    public function participant_list(Request $request)
    {
        $participant_list = Participent::where('meeting_id',$request->meeting_number)->get();
        $participants=' <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Change Status</th>';

        if(!session('vendoruser'))
            $participants.='<th>Change Password</th>';

        $participants.='</tr>
                                </thead>
                                <tbody>';
        $i=1;
        foreach($participant_list as $participant)
        {

            $message = "Active";
            if($participant->status==1)
                $message="Inactive";

            $url = route('update-participant-status', [
                    'status' => $participant->status,
                    'id' => $participant->id
                ]);

            $password_url = route('update-participant-password', [
                    'id' => $participant->id
                ]);
            

            

            $participants.="<tr>
                <td> <input type='checkbox' name='participants' value=".$participant->id."></td>
                <td>".$participant->full_name."</td>
                <td>".$participant->email."</td>
                <td>".$participant->phone."</td>
                <td><a class='btn btn-info' href='" . $url . "' onclick=' return confirm(`Are you sure?`)'>Make " . $message . "</a></td>
                ";
            if(!session('vendoruser'))
            $participants.="<td><a class='btn btn-info' href='" . $password_url . "' onclick=' return confirm(`Are you sure?`)'> Set Default Password </a></td>";
            
            $participants.="</tr>";
        }

        $participants.='</tbody>';


        $active_participants = $this->getLiveParticipants($request->meeting_number);
        return response()->json([
            'success' => true,
            'data'=>[
                'participants'=>$participants,
                'active_participants'=>$active_participants
            ]
            
        ]);
    }

    public function getLiveParticipants($meeting_number)
    {
       $participant_list = Participent::where('meeting_id',$meeting_number)
                            ->where('active',1)
                            ->get();
        $participants=' <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Change Status</th>';

        if(!session('vendoruser'))
            $participants.='<th>Change Password</th>';

        $participants.='</tr>
                                </thead>
                                <tbody>';
        $i=1;
        foreach($participant_list as $participant)
        {

            $message = "Active";
            if($participant->status==1)
                $message="Inactive";

            $url = route('update-participant-status', [
                    'status' => $participant->status,
                    'id' => $participant->id
                ]);

            $password_url = route('update-participant-password', [
                    'id' => $participant->id
                ]);
            

            

            $participants.="<tr>
                <td>".$i++."</td>
                <td>".$participant->full_name."</td>
                <td>".$participant->email."</td>
                <td>".$participant->phone."</td>
                <td><a class='btn btn-info' href='" . $url . "' onclick=' return confirm(`Are you sure?`)'>Make " . $message . "</a></td>
                ";
            if(!session('vendoruser'))
            $participants.="<td><a class='btn btn-info' href='" . $password_url . "' onclick=' return confirm(`Are you sure?`)'> Set Default Password </a></td>";
            
            $participants.="</tr>";
        }

        $participants.='</tbody>';

        return $participants;
    }

    public function send_bulk_email(Request $request)
    {
        $ids = $request->input('ids'); // Get the list of emails from the request
        $emailBody = $request->emailBody;
        $emailSubject=$request->emailSubject;
    
        // Loop through each email and send an email (example with Laravel Mail)
        foreach ($ids as $id) {
            $subject=$emailSubject;
            $view="emails.bulk";
            $record = Participent::where('id',$id)->first();
            $body=[ "user_name"=>$record->full_name,"meeting_number"=>$record->meeting_id,"body"=>$emailBody];
            Mail::to($record->email)->send(new SendEmail($subject,$view,$body));
        }
    }
}
