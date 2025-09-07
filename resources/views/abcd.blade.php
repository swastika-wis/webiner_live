{{-- <!DOCTYPE html>
<html>
<head>
    <title>Join Zoom Meeting</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Zoom SDK CSS -->
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.17.0/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.17.0/css/react-select.css" />

    <!-- Zoom SDK JS -->
    <script src="https://source.zoom.us/2.17.0/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/2.17.0/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/2.17.0/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/2.17.0/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/2.17.0/lib/vendor/jquery.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-2.17.0.min.js"></script>
</head>
<body>
    <div id="zmmtg-root"></div>
    <div id="aria-notify-area"></div>

    <script>
        ZoomMtg.setZoomJSLib('https://source.zoom.us/2.17.0/lib', '/av');
        ZoomMtg.preLoadWasm();
        ZoomMtg.prepareJssdk();

        const meetConfig = {
            apiKey: "{{ env('ZOOM_API_KEY') }}",
            meetingNumber: "{{ $meetingId }}",
            userName: "Laravel User",
            passWord: "gT4gx6", // optional if meeting has passcode
            role: 1, // host
            leaveUrl: "{{ url('/') }}"
        };

        fetch("{{ route('zoom.signature') }}?meetingNumber=" + meetConfig.meetingNumber + "&role=" + meetConfig.role)
            .then(res => res.json())
            .then(data => {
                ZoomMtg.init({
                    leaveUrl: meetConfig.leaveUrl,
                    success: function () {
                        ZoomMtg.join({
                            signature: data.signature,
                            meetingNumber: meetConfig.meetingNumber,
                            userName: meetConfig.userName,
                            apiKey: meetConfig.apiKey,
                            passWord: meetConfig.passWord,
                            success: () => console.log("Joined successfully"),
                            error: (err) => console.error(err),
                        });
                    }
                });
            });
    </script>
</body>
</html> --}}


<!DOCTYPE html>
<html>
<head>
    <title>Join Zoom Meeting</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="meetingSDKElement" style="width: 100%; height: 600px;"></div>

    @vite('resources/js/zoom.js')
</body>
</html>