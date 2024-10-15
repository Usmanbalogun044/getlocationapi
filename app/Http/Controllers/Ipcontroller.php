<?php

namespace App\Http\Controllers;

use App\Models\ipmodel;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Ipcontroller extends Controller
{
    public function collectip(Request $request)
    {
    $ip_address = $request->ip();
    $client = new Client();
    try {
        $response = $client->request('GET', 'https://ipgeolocation.abstractapi.com/v1/?api_key=06947a115645421094627d0f1c0bb406&ip_address=' . $ip_address);

        $data = json_decode($response->getBody(), true);
        $city = $data['city'] ?? null;
        $region = $data['region'] ?? null;
        $country = $data['country'] ?? null;
        $latitude = $data['latitude'] ?? null;
        $longitude = $data['longitude'] ?? null;

        $data = ipmodel::create([
            'ip_address' => $ip_address,
            'city' => $city,
            'region' => $region,
            'country' => $country,
            'latitude' => $latitude,
            'longitude' => $longitude
        ]);

        return response()->json(['message' => 'IP address and location data collected successfully', 'data'=>$data], 200);
    } catch (\Exception $e) {
        Log::error('Error collecting IP address and location data: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to collect IP address and location data'], 500);
    }
}

}
