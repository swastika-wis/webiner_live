<?php

namespace App\Http\Controllers;

use App\Models\MeetingModel;
use App\Models\Participent;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Services\ZoomService;
use Illuminate\Support\Facades\Crypt;

class MeetingController extends Controller
{
    protected $zoomService;

    public function __construct(ZoomService $zoomService)
    {
        $this->zoomService = $zoomService;
    }

    public function index($type)
    {
        $db_meetings = MeetingModel::get()->pluck('meeting_number')->toArray();
        $vendor_meetings = MeetingModel::get()->pluck('vendor_id','meeting_number')->toArray();
        
        
        $meetings = $this->zoomService->listOfAllMeeting($type); 
        return view('admin.zoom_meetings', ['meetings' => $meetings],compact('db_meetings','vendor_meetings'));
    }

    public function create(Request $request)
    {
        $vendors = Vendor::get();
        return view('admin.create_meeting',compact('vendors'));
    }
    public function store(Request $request)
    {
        $meetingData = [
            'topic' => $request->topic,
            'type' => 2, // Scheduled meeting
            'start_time' => now()->addHour()->toIso8601String(),
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
        $meeting_reocrd=new MeetingModel();
        $meeting_reocrd->vendor_id=$request->meeting_vendor;
        $meeting_reocrd->topic=$request->topic;
        $meeting_reocrd->meeting_number=$meeting['id'];
        $meeting_reocrd->meeting_details=response()->json($meeting);
        $meeting_reocrd->save();
        //return response()->json($meeting);
        return redirect()->route('meeting',['type' => $type]);
    }

    public function register_user(Request $request,$meeting_id)
    {
        $record=MeetingModel::where('meeting_number',Crypt::decrypt($meeting_id))->first();
        return view("admin.register_user",compact('meeting_id','record'));
    }

    public function store_participent(Request $request)
    {
        $record = new Participent();
        $record->full_name=$request->name;
        $record->email=$request->email;
        $record->phone=$request->phone;
        $record->meeting_id=Crypt::decrypt($request->meeting_id);
        $record->password=bcrypt($request->password);
        $record->save();
        return redirect()->route('user-login');

    }
}
