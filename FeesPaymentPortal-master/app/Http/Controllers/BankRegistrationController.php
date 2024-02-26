<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\BankRegistrationRequest;

class BankRegistrationController extends Controller
{
    //
    public function submitForm(BankRegistrationRequest $request)
    {
        // Validation passed, prepare the data
        $data = $request->validated();

        // Create HTTP client
        $client = Http::withHeaders([
            'X-Client-Id' => 'epg-app',
            'X-Client-Secret' => '68b66372-1063-48e0-a5a5-7b29e3ba6ec1',
            'Content-Type' => 'application/json',
        ]);

        // Make the API request
        $response = $client->post('https://epgtest.ecocashholdings.co.zw/api/serviceRequest', $data);

        // Handle the response as needed
         // Handle the response
         $responseData = $response->json();

         // Check if the registration was successful
         if ($response->successful()) {
             // Registration successful, display a success message
             return view('success', ['message' => 'Registration successful']);
         } else {
             // Registration failed, display the error message
             $statusCode = $responseData['status'];
             $responseCode = $responseData['responseCode'];
             $exception = $responseData['exception'];
             $message = $responseData['message'];
 
             return view('error', compact('statusCode', 'responseCode', 'exception', 'message'));
         }
    }
}
