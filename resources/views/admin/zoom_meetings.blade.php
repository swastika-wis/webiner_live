@extends('layouts.app')

@section('title', 'My Vendors')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">My Meetings</h6>
        <a href="{{route('create-meeting')}}">Create Meeting</a>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <a href="{{route('meeting','scheduled')}}" class="btn btn-outline-success @if(Request::is('meetings/scheduled')) btn-success text-white @endif">
                ALl Meetings </a>
            <a href="{{route('meeting','upcoming')}}" class="btn btn-outline-success @if(Request::is('meetings/upcoming')) btn-success text-white @endif">Upcoming</a>
            <a href="{{route('meeting','live')}}" class="btn btn-outline-success @if(Request::is('meetings/live')) btn-success text-white @endif">Live</a>
        </div>
        <div class="table-responsive">
            <table class="table table-secondary table-bordered table-hover " id="dataTable2" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <td>Duration</td>
                        <td>Meeting Topic</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse($meetings as $meeting)

                    @php
                        // Map timezones to friendly labels
                        $timezoneLabels = [
                            'Asia/Kolkata' => 'Mumbai, Kolkata, New Delhi',
                            'America/New_York' => 'New York, Washington DC',
                            'Europe/London' => 'London, Dublin',
                            'Asia/Tokyo' => 'Tokyo, Osaka',
                        ];
                    
                        $timezone = $meeting['timezone'] ?? 'Asia/Kolkata';
                        $start = \Carbon\Carbon::parse($meeting['start_time'])->setTimezone($timezone);
                        $end = (clone $start)->addMinutes($meeting['duration']);
                    
                        // Pick friendly label if exists, otherwise fallback
                        $tzLabel = $timezoneLabels[$timezone] ?? str_replace('_', ' ', explode('/', $timezone)[1] ?? $timezone);

                        $join_url=explode('pwd=',$meeting['join_url']);
                        
                    @endphp
                
                        <tr>
                            <td> 
                                <div>
                                    {{ $start->format('h:i A') }} - {{ $end->format('h:i A') }} 
                                </div>
                                <div>
                                    {{$tzLabel}}
                                </div>
                            </td>
                            <td>
                                <div>
                                    {{$meeting['topic']}}
                                </div>
                                <div>
                                    Meeting ID: {{$meeting['id']}}
                                </div>
                            </td>
                            <td>
                                <a href="javascript:void(0)" onclick="startMeeting('{{$meeting['id']}}','{{$join_url[1]}}')" class="btn btn-primary">Start</a>
                                
                            </td>

                            <td>
                                <a href="">Share Registration Link</a>
                            </td>
                        </tr>
                    @empty
                        No Meetings Listed
                    @endforelse 
                    
                </tbody>
            </table>

        </div>
    </div>
</div>




@endsection


@section('extra_js')

<script src="https://source.zoom.us/4.0.5/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/4.0.5/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/4.0.5/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/4.0.5/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/4.0.5/zoom-meeting-4.0.5.min.js"></script>

<script>
    // const ZoomMtg = window.ZoomMtg;
    // ZoomMtg.preLoadWasm();
    // ZoomMtg.prepareWebSDK();

    async function getSignature(meetingNumber, role) {
        // Call Laravel API route
        const response = await fetch("{{ url('/api/zoom-signature') }}", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                meetingNumber: meetingNumber,
                role: role
            }),
        });
        return await response.json();
    }

    function startMeeting(meetingNumber,passWord) {
        const role = 1; // 0 = attendee, 1 = host



        getSignature(meetingNumber, role).then(({ signature, sdkKey }) => {

            ZoomMtg.init({
                leaveUrl: "http://www.zoom.us",
                success: () => {
                    ZoomMtg.join({
                        signature: signature,
                        sdkKey: @json(env('ZOOM_SDK_KEY')),
                        meetingNumber: meetingNumber,
                        userName: "swastika.wis@gmail.com",
                        userEmail: "swastika.wis@gmail.com",
                        passWord: passWord,
                        success: (res) => console.log("Join success", res),
                        error: (err) => console.error("Join error", err),
                    });
                },
                error: (err) => console.error("Init error", err),
            });
        });
    }
</script>

@endsection
