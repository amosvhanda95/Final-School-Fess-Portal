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
                'rate' => 19.4297,
            ],
            [
                'country' => 'UK',
                'currency' => 'EUR',
                'rate' => 0.9482,
            ],
            // Add more data for other countries as needed
        ];

        // Insert the data into the 'fxrates' table
        DB::table('fxrates')->insert($countriesData);
    }
}
