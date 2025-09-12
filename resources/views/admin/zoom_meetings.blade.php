@extends('layouts.app')

@section('title', 'List of meetings')

@section('extra_css')
<link href="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.css" rel="stylesheet" >

<style>
     .copied-msg {
      color: green;
      margin-top: 10px;
      display: none;
    }
</style>

@endsection



@section('content')

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
                                <div class="dropdown">
                                    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Dropdown button  </button>
                                    
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        
                                        <a href="javascript:void(0);" class="dropdown-item"  onclick="copyLink('{{route('register-user',\Crypt::encrypt($meeting['id']))}}')">Share User Registration Link</a>



                                        <a href="javascript:void(0);" class="dropdown-item"  onclick="copyLinkLogin('{{route('vendor-login',\Crypt::encrypt($vendor_meetings[$meeting['id']]))}}')">Share Vendor Link</a>

                                    </div>
                                </div>
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
    <div class="modal-dialog modal-lg modal-dialog-scrollable"> <!-- modal-lg for wider modal -->
        <div class="modal-content">
          
            <div class="modal-body">

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                     <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="participation-table-tab" data-bs-toggle="tab" data-bs-target="#table-tab-pane" type="button" role="tab">All Participants</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info-tab-pane" type="button" role="tab">Active Participants</button>
                    </li>
                   
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3">


                    <!-- Table Tab -->
                    <div class="tab-pane fade show active" id="table-tab-pane" role="tabpanel">
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
            <div class="modal-footer d-flex justify-content-between">
               
                <button class="btn btn-secondary" data-bs-dismiss="modal">Send Email to ALL</button>

                <div>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save</button>
                </div>
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
<script src="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.js"></script>

<script>
    // const ZoomMtg = window.ZoomMtg;
    // ZoomMtg.preLoadWasm();
    // ZoomMtg.prepareWebSDK();

    //let table = new DataTable('#participants_list');

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
        const message = "Link copied to clipboard!";        
        $('#myToast').toast('show');
        $("#toast_message").text(message);
        
      });
    }

    function copyLinkLogin(linkInput) {     
     // Copy the text
     navigator.clipboard.writeText(linkInput).then(function() {
     // Show confirmation message
     const message = "Link copied to clipboard!";

     $('#myToast').toast('show');
     $("#toast_message").text(message);

      });
    }




 function showParticipantList(meetingNumber) {
    const csrfToken = "{{ csrf_token() }}";
    $.ajax({
        headers: { 'X-CSRF-TOKEN': csrfToken },
        url: "{{ route('partcipant-list') }}",
        method: 'POST',
        data: {
            meeting_number: meetingNumber
        },
        success: function(response) {
            $("#participant_modal").modal('show');
            $("#participants_list").html(response.data.participants);

            // Ensure the DataTable is initialized after content is inserted
            setTimeout(function () {
                if ($.fn.DataTable.isDataTable('#participants_list')) {
                    $('#participants_list').DataTable().destroy();  // Destroy previous DataTable instance
                }
                $('#participants_list').DataTable();  // Initialize DataTable
            }, 100); // Delay to ensure the content is loaded
        },
    });
}




</script>

@endsection
