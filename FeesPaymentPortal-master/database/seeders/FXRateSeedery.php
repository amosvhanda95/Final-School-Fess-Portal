<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class FXRateSeeder extends Seeder
{
    public function run()
    {
        $client = new Client();
        $response = $client->get('https://restcountries.com/v3/all');
        $countriesData = json_decode($response->getBody(), true);
dd($countriesData );
        $fxRatesData = [];
        foreach ($countriesData as $country) {
            $currencies = $country['currencies'] ?? null;

            if ($currencies && is_array($currencies) && !empty($currencies)) {
                $currencyCode = reset($currencies)['code'] ?? null;

                if ($currencyCode) {
                    $fxRatesData[] = [
                    'country' => $country['name']['common'],
                    'currency' => $country['currencies'][$currencyCode]['name']['common'],
                    'currency_code' => $currencyCode,
                    'country_code' => $country['cca2'],
                    'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3',
                    'rate' => 2.3456, // Change the rate as needed
   
                    ];
                }
            }
        }

        DB::table('fxrates')->insert($fxRatesData);
    }
}
