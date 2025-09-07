<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class ZoomController extends Controller
{
    public function generateSignature(Request $request)
    {
        // Your Zoom Meeting SDK Key and Secret
        $sdkKey =  config('services.zoom.sdk_key');
        $sdkSecret =config('services.zoom.sdk_secret');
        $meetingNumber = $request->meetingNumber;
        //$role = $request->input('role', 1); // 0 for attendee, 1 for host
        $role = $request->role;

        // The token expiry time (one hour)
        $expiry = time() + 3600;

        $payload = [
            'sdkKey' => $sdkKey,
            'mn' => $meetingNumber,
            'role' => $role,
            'iat' => time(),
            'exp' => $expiry,
            'tokenExp' => $expiry,
        ];

        try {
            $jwt = JWT::encode($payload, $sdkSecret, 'HS256');
            return response()->json([
                'signature' => $jwt,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
