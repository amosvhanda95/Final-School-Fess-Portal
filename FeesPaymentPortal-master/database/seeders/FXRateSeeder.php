<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FXRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countriesData = [
            [
                'country' => 'South Africa',
                'currency' => 'ZAR',
                'country_code' => 'ZAF',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3',
                'rate' => 2.3456,
            ],
            [
                'country' => 'United States',
                'currency' => 'USD',
                'country_code' => 'USA',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Thailand',
                'currency' => 'THB',
                'country_code' => 'THA',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'United Kingdom',
                'currency' => 'GBP',
                'country_code' => 'GBR',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Canada',
                'currency' => 'CAD',
                'country_code' => 'CAN',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'United Arab Emirates',
                'currency' => 'AED',
                'country_code' => 'ARE',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Australia',
                'currency' => 'AUD',
                'country_code' => 'AUS',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Poland',
                'currency' => 'PLN',
                'country_code' => 'POL',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Japan',
                'currency' => 'JPY',
                'country_code' => 'JPN',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Switzerland',
                'currency' => 'CHF',
                'country_code' => 'CHE',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Hong Kong',
                'currency' => 'HKD',
                'country_code' => 'HKG',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Singapore',
                'currency' => 'SGD',
                'country_code' => 'SGP',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Zambia',
                'currency' => 'ZMW',
                'country_code' => 'ZMB',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'India',
                'currency' => 'INR',
                'country_code' => 'IND',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Pakistan',
                'currency' => 'PKR',
                'country_code' => 'PAK',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Malaysia',
                'currency' => 'MYR',
                'country_code' => 'MYS',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'China',
                'currency' => 'CNY',
                'country_code' => 'CHN',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Mozambique',
                'currency' => 'MZN',
                'country_code' => 'MOZ',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Malawi',
                'currency' => 'MWK',
                'country_code' => 'MWI',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Andorra',
                'currency' => 'Euro',
                'country_code' => 'ADO',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Austria',
                'currency' => 'Euro',
                'country_code' => 'AUT',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Belgium',
                'currency' => 'Euro',
                'country_code' => 'BEL',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Croatia',
                'currency' => 'Euro',
                'country_code' => 'HRV',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Cyprus',
                'currency' => 'Euro',
                'country_code' => 'CYP',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Estonia',
                'currency' => 'Euro',
                'country_code' => 'EST',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Finland',
                'currency' => 'Euro',
                'country_code' => 'FIN',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'France',
                'currency' => 'Euro',
                'country_code' => 'FRA',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Germany',
                'currency' => 'Euro',
                'country_code' => 'DEU',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Greece',
                'currency' => 'Euro',
                'country_code' => 'GRC',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Ireland',
                'currency' => 'Euro',
                'country_code' => 'IRL',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Italy',
                'currency' => 'Euro',
                'country_code' => 'ITA',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Latvia',
                'currency' => 'Euro',
                'country_code' => 'LVA',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Lithuania',
                'currency' => 'Euro',
                'country_code' => 'LTU',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Luxembourg',
                'currency' => 'Euro',
                'country_code' => 'LUX',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Malta',
                'currency' => 'Euro',
                'country_code' => 'MLT',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Monaco',
                'currency' => 'Euro',
                'country_code' => 'MCO',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Netherlands',
                'currency' => 'Euro',
                'country_code' => 'NLD',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'Portugal',
                'currency' => 'Euro',
                'country_code' => 'PRT',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as needed
            ],
            [
                'country' => 'San Marino',
                'currency' => 'Euro',
                'country_code' => 'SMR',
                'card_rate_id' => '11m0043ur22y4y1hfpkg266sfo3#',
                'rate' => 2.3456, // Change the rate as
        
            ],
        ];

        $sepaCountries = [
            
        ];
        
        
        DB::table('fxrates')->insert($countriesData);
    }
}


