<?php

namespace App\Helpers;

class ZoomSignature
{
    public static function generate($apiKey, $apiSecret, $meetingNumber, $role)
    {
        $time = round(microtime(true) * 1000) - 30000; // timestamp
        $data = base64_encode($apiKey . $meetingNumber . $time . $role);

        $hash = hash_hmac('sha256', $data, $apiSecret, true);
        $sig = $apiKey . "." . $meetingNumber . "." . $time . "." . $role . "." . base64_encode($hash);

        // Convert to base64url
        return rtrim(strtr(base64_encode($sig), '+/', '-_'), '=');
    }
}
