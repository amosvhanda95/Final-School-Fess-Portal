<?php

namespace App\Http\Controllers;

use App\Models\Fxrate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ForexController extends Controller
{
    // Handle both fetching and updating forex rates
    public function updateForexRatesFromURL()
    {
        // Fetch data from the URL
        $response = Http::get('URL_OF_YOUR_FOREX_DATA_ENDPOINT');

        // Check if the request was successful
        if ($response->ok()) {
            $data = $response->json();

            // Update the database with the fetched data
            foreach ($data as $item) {
                $countryCode = $item['country_code'];
                $newRate = $item['rate'];

                // Update the rate in the database for the corresponding country code
                Fxrate::where('country_code', $countryCode)->update(['rate' => $newRate]);
            }

            return response()->json(['message' => 'Forex rates updated successfully']);
        }

        // If the request failed, return an error response
        return response()->json(['error' => 'Failed to fetch forex data'], 500);
    }
}