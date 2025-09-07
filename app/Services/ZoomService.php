<?php 

namespace App\Services;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ZoomService
{
    protected function getAccessToken()
    {
        return Cache::remember('zoom_access_token', 3300, function () { // Cache for 55 mins
            $response = Http::asForm()->withBasicAuth(
                config('services.zoom.client_id'),
                config('services.zoom.client_secret')
            )->post('https://zoom.us/oauth/token', [
                'grant_type' => 'account_credentials',
                'account_id' => config('services.zoom.account_id'),
            ]);

            $response->throw(); // Throw an exception if a client or server error occurred

            return $response->json()['access_token'];
        });
    }

    public function createMeeting($data)
    {
        $accessToken = $this->getAccessToken();
        $response = Http::withToken($accessToken)
            ->post('https://api.zoom.us/v2/users/me/meetings', $data);

        $response->throw();

        return $response->json();
    }
    
    public function listOfAllMeeting( $type = 'scheduled')
    {
        $userId = '8ojqWW6uQDiesEVzJRIH0w';
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
        ->get("https://api.zoom.us/v2/users/8ojqWW6uQDiesEVzJRIH0w/meetings", [
            'type' => $type,     // 'scheduled', 'upcoming', 'live'
            'page_size' => 30,
        ]);

        if ($response->failed()) {
            return [];
        }

        return $response->json()['meetings'] ?? [];
    }

}