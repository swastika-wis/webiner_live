@extends('layouts.app')

@section('title', 'Host')

@section('content')

@endsection


@section('extra_js')
<script src="{{asset('/assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="https://source.zoom.us/4.0.5/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/4.0.5/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/4.0.5/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/4.0.5/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/4.0.5/zoom-meeting-4.0.5.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function(){
    

    const meetingNumber = @json($meeting_id);
    const passWord=@json($password);

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
    


    
});
</script>

@endsection