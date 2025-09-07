<?php

// app/Http/Controllers/ZohoController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ZohoController extends Controller
{
    private $clientId = '1000.KWX8O52S8SNPLOT8CLIRM489TCOUIT';
    private $clientSecret = '76275d13c26f31e75f8e3f139c101c08992e67a11e';
    private $redirectUri = 'http://localhost:8003/start-conference';

    // Step 1: Redirect to Zoho OAuth
    public function redirectToZoho()
    {
        $url = "https://accounts.zoho.com/oauth/v2/auth?" . http_build_query([
            "scope" => "ZohoMeeting.webinars.READ,ZohoMeeting.webinars.CREATE",
            "client_id" => $this->clientId,
            "response_type" => "code",
            "access_type" => "offline",
            "redirect_uri" => $this->redirectUri,
        ]);

        return redirect($url);
    }

    // Step 2: Handle OAuth Callback
    public function handleCallback(Request $request)
    {

       // dd($_POST);
        $code = $request->query('code');

        $response = Http::asForm()->post("https://accounts.zoho.com/oauth/v2/token", [
            'code' => $code,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'grant_type' => 'authorization_code',
        ]);

        $tokens = $response->json();
        Session::put('zoho_access_token', $tokens['access_token']);
        Session::put('zoho_refresh_token', $tokens['refresh_token']);

        return redirect('/zoho/webinars');
    }

    // Step 3: List Webinars
    public function listWebinars()
    {
        $accessToken = Session::get('zoho_access_token');

        $response = Http::withToken($accessToken)
            ->get("https://meeting.zoho.com/api/v2/webinars");

        return $response->json();
    }

    // Step 4: Create Webinar Example
    public function createWebinar()
    {
        $accessToken = Session::get('zoho_access_token');

        $response = Http::withToken($accessToken)->post("https://meeting.zoho.com/api/v2/webinars", [
            "topic" => "My Test Webinar",
            "description" => "Testing Laravel + Zoho",
            "schedule" => [
                "startTime" => "2025-09-28T10:00:00Z",
                "duration" => 60
            ]
        ]);

        return $response->json();
    }

    public function refreshToken()
    {
        $refreshToken = Session::get('zoho_refresh_token');

        $response = Http::asForm()->post("https://accounts.zoho.com/oauth/v2/token", [
            'refresh_token' => $refreshToken,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'refresh_token',
        ]);

        $tokens = $response->json();
        Session::put('zoho_access_token', $tokens['access_token']);

        return $tokens;
    }

    public function getAccessToken(Request $request)
    {
       $code = $request->query('code');

       $response = Http::asForm()->post("https://accounts.zoho.in/oauth/v2/token", [
            'code' => $code,
            'client_id' => "1000.KWX8O52S8SNPLOT8CLIRM489TCOUIT",
            'client_secret' => "76275d13c26f31e75f8e3f139c101c08992e67a11e",
            'redirect_uri' => "http://localhost:8003/start-conference",
            'grant_type' => 'authorization_code',
        ]);

       return $response->json();
    }
    // {

    //  $url = env('ZOHO_ACCOUNTS_URL')."/oauth/v2/auth?" . http_build_query([
    //         'scope' => 'ZohoMeeting.webinar.ALL',
    //         'client_id' => env('ZOHO_CLIENT_ID'),
    //         'response_type' => 'code',
    //         'access_type' => 'offline',
    //         'redirect_uri' => env('ZOHO_REDIRECT_URI'),
    //     ]);
    //     return redirect($url);

    // }
}
