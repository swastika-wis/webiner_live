<?php

namespace App\Http\Controllers;

use App\Helpers\ZoomSignature;
use App\Services\ZoomService;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
   public function index()
   {
        return view('admin.webinar');
   }

    public function create(Request $request)
    {
        // $request->validate([
        //     'topic'      => 'required|string',
        //     'start_time' => 'required|date',
        //     'duration'   => 'required|integer',
        //     'user_id'    => 'required|string', // Zoom host userId or email
        // ]);

        $zoom = new ZoomService();
         $meeting = $zoom->createMeeting(
           $request->topic,
           $request->start_time,
           $request->duration,
        );
        

        $webinar = $zoom->createWebinar($request->user_id, $request->only('topic', 'start_time', 'duration'));

        return response()->json($webinar);
    }

     public function getSignature(Request $request)
    {
       try{
        $meetingNumber = "85708926156";
        $role = "1"; // 0 = participant, 1 = host

        $signature = ZoomSignature::generate(
            'UeYoTIhlQCuQMSTo0x22oQ',
            'QkJSr7s6xR84DgVE0f9gLM3Sx7iv26F5',
            $meetingNumber,
            $role
        );

        return response()->json(['signature' => $signature]);
       }catch(\Throwable $th){
        dd($th);
       }
    }

    
    public function joinMeeting($meetingId)
    {
        return view('abcd', compact('meetingId'));
    }
    
    
}
