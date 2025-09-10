@extends('layouts.app')

@section('title', 'My Vendors')

@section('content')

<style>
     .copied-msg {
      color: green;
      margin-top: 10px;
      display: none;
    }
</style>


<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold text-primary">My Meetings</h5><hr>
        <a href="{{route('create-meeting')}}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>
            Create Meeting
        </a>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <a href="{{route('meeting','scheduled')}}" class="btn btn-outline-success @if(Request::is('meetings/scheduled')) btn-success text-white @endif">
                ALl Meetings </a>
            <a href="{{route('meeting','upcoming')}}" class="btn btn-outline-success @if(Request::is('meetings/upcoming')) btn-success text-white @endif">Upcoming</a>
            <a href="{{route('meeting','live')}}" class="btn btn-outline-success @if(Request::is('meetings/live')) btn-success text-white @endif">Live</a>
        </div>
        <div class="table-responsive">
            <table class="table table-secondary table-hover " id="dataTable2" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <td>Duration</td>
                        <td>Meeting Topic</td>
                        <td>Paticipant List</td>
                        <td colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse($meetings as $meeting)
                    @if(in_array($meeting['id'],$db_meetings))
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
                                <a href="javascript:void(0)" onclick="showParticipantList('{{$meeting['id']}}')" class="btn btn-primary text-white btn-sm">Show Participant List</a>                                
                            </td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-warning text-white btn-sm"  onclick="copyLinkLogin('{{route('vendor-login',\Crypt::encrypt($vendor_meetings[$meeting['id']]))}}')">Share Vendor Link</a>


                                <div class="copied-msg" id="copiedMessageLogin">Link copied to clipboard!</div>

                            </td>

                            <td>
                                <a href="javascript:void(0);" class="btn btn-info text-white btn-sm"  onclick="copyLink('{{route('register-user',\Crypt::encrypt($meeting['id']))}}')">Share User Registration Link</a>


                                <div class="copied-msg" id="copiedMessage">Link copied to clipboard!</div>

                            </td>
                        </tr>
                    @endif
                    @empty
                        No Meetings Listed
                    @endforelse 
                    
                </tbody>
            </table>

        </div>
    </div>
</div>



<div class="modal fade" id="participant_modal" tabindex="-1" aria-labelledby="tabModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- modal-lg for wider modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal with Tabs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                     <li class="nav-item" role="presentation">
                        <button class="nav-link" id="table-tab" data-bs-toggle="tab" data-bs-target="#table-tab-pane" type="button" role="tab">All Participants</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info-tab-pane" type="button" role="tab">Active Participants</button>
                    </li>
                   
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3">


                    <!-- Table Tab -->
                    <div class="tab-pane fade active" id="table-tab-pane" role="tabpanel">
                        <div class="table-scroll">
                            <table class="table table-bordered table-hover" id="participants_list">
                                
                            </table>
                        </div>
                    </div>

                    <!-- Info Tab -->
                    <div class="tab-pane fade show " id="info-tab-pane" role="tabpanel">
                        <p>This is some informational content in the first tab.</p>
                    </div>

                    
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>


@endsection


@section('extra_js')
<script src="{{asset('/assets/js/jquery-3.7.1.min.js')}}"></script>
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
                leaveUrl: "http://localhost:1234/meetings/scheduled",
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

    

      function copyLink(linkInput) {
     
        // Copy the text
        navigator.clipboard.writeText(linkInput).then(function() {
        // Show confirmation message
        const message = document.getElementById("copiedMessage");
        message.style.display = "block";

        // Hide it again after 2 seconds
        setTimeout(() => {
          message.style.display = "none";
        }, 2000);
      });
    }

    function copyLinkLogin(linkInput) {
     
     // Copy the text
     navigator.clipboard.writeText(linkInput).then(function() {
     // Show confirmation message
     const message = document.getElementById("copiedMessageLogin");
     message.style.display = "block";

     // Hide it again after 2 seconds
     setTimeout(() => {
       message.style.display = "none";
     }, 2000);
   });
 }

 
 function showParticipantList(meetingNumber)
 {
    const csrfToken = "{{ csrf_token() }}";
    $.ajax({
         headers: {'X-CSRF-TOKEN': csrfToken},
        url: "{{ route('partcipant-list') }}",
        method: 'POST',
        data: {
            meeting_number: meetingNumber
        },
        success: function(response) {
            $("#participant_modal").modal('show');
            $("#participants_list").html(response.data.participants);
             let tabTrigger = new bootstrap.Tab(document.querySelector('#table-tab'));
    tabTrigger.show();
        },
    });
 }

    
</script>

@endsection
