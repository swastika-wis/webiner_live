@extends('layouts.app')

@section('title', 'Host')


@section('styles')
<style>
    /* Hide Zoom Workplace banner - WARNING: Not officially supported */
    .ReactModalPortal {
        display: none !important;
    }
</style>
@endsection


@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-theme">Meetings</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="dataTable2" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Duration</th>
                        <th>Meeting Topic</th>
                        <td>Paticipant List</td>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($meetings as $meeting)
                    @php 
                        
                        $raw = $meeting->meeting_details;
                        $jsonPart = substr($raw, strpos($raw, '{'));
                        $data = json_decode($jsonPart, true);
                        $password=explode('pwd=',$data['join_url']);
                       //dd($data);
                        
                    @endphp 
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data['duration']}} Minutes</td>

                            
                            <td>{{$data['topic']}}</td>

                             <td>
                                <a href="javascript:void(0)" onclick="showParticipantList('{{$data['id']}}')" class="btn btn-primary">Show Participant List</a>                                
                            </td>
                            <td><a href="javascript:void(0)" class="btn btn-primary py-2 px-4 rounded-2 text-white" onclick="startMeeting('{{$data['id']}}','{{$password[1]}}')">Start</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<iframe class="pwa-webclient__iframe" id="webclient" src="https://app.zoom.us/wc/82044906792/join?from=pwa" role="presentation" height="600px" width="100%"></iframe>


{{-- <iframe class="pwa-webclient__iframe" id="webclient" src="https://app.zoom.us/wc/82044906792/join?from=pwa" role="" height="600px" width="100%"></iframe> --}}


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
                leaveUrl: "https://webideasolution.in/webiner/vendor-dashboard",
                patchJsMedia: true,
                success: () => {
                    ZoomMtg.join({
                        signature: signature,
                        sdkKey: @json(env('ZOOM_SDK_KEY')),
                        meetingNumber: meetingNumber,
                        userName: @json(Auth::guard('vendoruser')->user()?->user_name),
                        userEmail: @json(Auth::guard('vendoruser')->user()?->user_name),
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


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const targetNode = document.getElementById('zmmtg-root');
        
        if (!targetNode) return;
    
        const observer = new MutationObserver((mutationsList, observer) => {
            const banner = targetNode.querySelector('.meeting-app__branding');
            if (banner) {
                banner.style.display = 'none';
            }
    
            const loading = targetNode.querySelector('.ReactModalPortal');
            if (loading) {
                loading.style.display = 'none';
            }
        });
    
        observer.observe(targetNode, { childList: true, subtree: true });
    });
    </script>

    <script>
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

