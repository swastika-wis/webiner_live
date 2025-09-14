@extends('layouts.app')

@section('title', 'Paticipent')


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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($meetings as $meeting)
                    @php 
                        $raw = $meeting->meeting_details;
                        $jsonPart = substr($raw, strpos($raw, '{'));
                        $data = json_decode($jsonPart, true);
                        $password = explode('pwd=', $data['join_url']);
                    @endphp 
                    <tr>
                        <td data-label="ID">{{$loop->iteration}}</td>
                        <td data-label="Duration">30 min</td>
                        <td data-label="Meeting Topic">{{$data['topic']}}</td>
                        {{-- <td data-label="Action">
                            <a href="javascript:void(0)" onclick="startMeeting('{{$data['id']}}','{{$password[1]}}')" class="btn btn-sm btn-primary text-white">Join</a>
                        </td> --}}

                        <td>
                            <a href="{{route('join-meeting',$data['id'])}}" class="btn btn-sm btn-primary text-white ">Join Here </a>
                        </td>
                    </tr>
                    @endforeach
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
        const role = 0; // 0 = attendee, 1 = host

        getSignature(meetingNumber, role).then(({ signature, sdkKey }) => {

            ZoomMtg.init({
                leaveUrl: "https://webideasolution.in/webiner/user-dashboard",
                success: () => {
                    ZoomMtg.join({
                        signature: signature,
                        sdkKey: @json(env('ZOOM_SDK_KEY')),
                        meetingNumber: meetingNumber,
                        userName: @json(session('webuser')->email),
                        userEmail: @json(session('webuser')->email),
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

@endsection

