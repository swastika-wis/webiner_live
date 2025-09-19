import { ZoomMtg } from '@zoom/meetingsdk'

// Required setup
ZoomMtg.preLoadWasm()
ZoomMtg.prepareWebSDK()

// Meeting configuration
const meetConfig = {
    sdkKey: "2aYjSWKoS_m8PyGSE9YyxQ", 
    meetingNumber: document.querySelector('meta[name="meeting-id"]').content,
    userName: "Laravel User",
    passWord: document.querySelector('meta[name="meeting-pass"]').content,
    role: 0, // 0 = participant, 1 = host
    leaveUrl: window.location.origin,
}

// Fetch signature from Laravel backend
fetch(`/zoom-signature?meetingNumber=${meetConfig.meetingNumber}&role=${meetConfig.role}`)
    .then(res => res.json())
    .then(({ signature }) => {
        ZoomMtg.init({
            leaveUrl: meetConfig.leaveUrl,
            success: () => {
                ZoomMtg.join({
                    signature,
                    sdkKey: meetConfig.sdkKey,
                    meetingNumber: meetConfig.meetingNumber,
                    userName: meetConfig.userName,
                    passWord: meetConfig.passWord,
                    success: () => console.log("Joined"),
                    error: (err) => console.error("Error", err),
                })
            }
        })
    })
