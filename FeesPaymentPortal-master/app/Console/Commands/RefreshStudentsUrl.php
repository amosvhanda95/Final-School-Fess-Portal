<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RefreshStudentsUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:students-url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the students URL';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Make an HTTP GET request to refresh the URL
        $response = Http::get('http://127.0.0.1:8000/get-students');

        // Check if the request was successful (status code 200)
        if ($response->successful()) {
            $this->info('URL refreshed successfully.');
            return Command::SUCCESS;
        } else {
            $this->error('Failed to refresh the URL.');
            return Command::FAILURE;
        }
    }
}
