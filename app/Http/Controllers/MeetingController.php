<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ZoomService;

class MeetingController extends Controller
{
    protected $zoomService;

    public function __construct(ZoomService $zoomService)
    {
        $this->zoomService = $zoomService;
    }

    public function index($type)
    {
        $meetings = $this->zoomService->listOfAllMeeting($type); 
        return view('admin.zoom_meetings', ['meetings' => $meetings]);
    }

    public function create(Request $request)
    {
        return view('admin.create_meeting');
    }
    public function store(Request $request)
    {
        $meetingData = [
            'topic' => $request->input('topic'),
            'type' => 2, // Scheduled meeting
            'start_time' => now()->addHour()->toIso8601String(),
            'duration' => 60,
            'timezone' => 'Asia/Kolkata',
        ];

        $meeting = $this->zoomService->createMeeting($meetingData);
        $type="upcoming";
       // return response()->json($meeting);
        return redirect()->route('meeting',['type' => $type]);
    }
}
