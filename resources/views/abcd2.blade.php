<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
{{--     
    <iframe src="https://app.zoom.us/wc/85708926156/start?fromPWA=1&pwd=bJl8KHVqA1huHz66yaWRRFpAmWjSJk.1" 
    allow="camera; microphone; display-capture" height="600" width="100%"></iframe> --}}


    <iframe src="https://us05web.zoom.us/j/8203323846?pwd=kQniWV4JghpJMXv8OKYaY17QURfCHn.1" 
    allow="camera; microphone; display-capture" height="600" width="100%"></iframe>


    

    <div id="zmmtg-root"></div>
<div id="aria-notify-area"></div>
<div id="meetingSDKElement"></div>

<script src="https://source.zoom.us/2.18.2/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/2.18.2/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/zoom-meeting-2.18.2.min.js"></script>

<script>
  ZoomMtg.setZoomJSLib('https://source.zoom.us/2.18.2/lib', '/av');

  ZoomMtg.preLoadWasm();
  ZoomMtg.prepareWebSDK();

  ZoomMtg.init({
    leaveUrl: "https://yourdomain.com/thankyou",
    success: () => {
      ZoomMtg.join({
        sdkKey: "YOUR_SDK_KEY",
        signature: "GENERATED_SIGNATURE",
        meetingNumber: "85708926156",
        passWord: "2Yv5M3",
        userName: "Guest User",
        userEmail: "guest@example.com"
      });
    }
  });
</script>


</body>
</html>