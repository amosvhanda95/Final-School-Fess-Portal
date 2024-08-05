<?php

namespace App\Http\Controllers;

use App\Models\Sendmoney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mastercard\Developer\OAuth\OAuth;
use Mastercard\Developer\OAuth\Utils\AuthenticationUtils;

class CrossborderPaymentController extends Controller
{
    public function index( )

    {
        $data = Sendmoney::orderBy('created_at', 'desc')->paginate(10);
        return view('crossboarder.payment.index', compact('data'));  
    }

    public function show($id)
    {
        $sendmoney = Sendmoney::with(['user.branch'])->find($id);
        // Retrieve the logged-in user
    $loggedInUser = Auth::user();

    // Check if the logged-in user has a branch associated
    $branch = $loggedInUser->branch ?? null;
   
        return view('crossboarder.payment.show', compact('sendmoney', 'branch'));
    }
    
    

    public function ratesRequest()
    {
        // Load your signing key
        $signingKey = AuthenticationUtils::loadSigningKey(
            'API-TEST2-sandbox.p12',
            'keyalias',
            'keystorepassword'
        );
    
        // Define your Mastercard credentials and endpoint
        $consumerKey = 'eEHw5mRX6ZsPQtjBaIx9_JeobetpR3MwrqxKBzTs29db017c!9b0af67b746443748ceb659ff77bc9ba0000000000000000';
    
        $uri = 'https://sandbox.api.mastercard.com/send/v1/partners/BEL_MCSXB1HS5f/crossborder/rates';
        $method = 'GET';
    
        $RatesRequestData = [
            "rates" => [
                "rate" => [
                    "partner_id" => "BEL_MCSXB1HS5f",
                    "type" => "single",
                    "use" => "CMSP",
                    "from_currency_code" => "USD",
                    "to_currency_code" => "GBP",
                    "account_type" => "BANK",
                ]
            ]
        ];
        
    
        $payload = json_encode($RatesRequestData, JSON_PRETTY_PRINT);
    
        $headers = [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload),
            'Authorization: ' . OAuth::getAuthorizationHeader($uri, $method, $payload, $consumerKey, $signingKey)
        ];
    
        // Initialize cURL session
        $ch = curl_init($uri);
    
        // Set cURL options
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Execute the cURL session
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            // Handle the error here, e.g., log it or return an error response
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            // Display the response
            echo 'API Response: ' . $response;
    
            // Process the API response (e.g., decode JSON)
            $responseData = json_decode($response, true);
    
            // Handle the response data
            // ...
        }
    
        // Close the cURL session
        curl_close($ch);
    }
    
}
