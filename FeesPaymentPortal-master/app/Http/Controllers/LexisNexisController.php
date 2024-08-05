<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sendmoney;
use App\Models\Beneficiary;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\EthixTransaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Mastercard\Developer\Utils\EncryptionUtils;
use Mastercard\Developer\Encryption\JweEncryption;
use Mastercard\Developer\Signers\CurlRequestSigner;
use Mastercard\Developer\Encryption\JweConfigBuilder;
use Mastercard\Developer\OAuth\Utils\AuthenticationUtils;

class LexisNexisController extends Controller


{ 
    // Global properties
    protected $customer;
    protected $receiver;
    protected $senderFirstName;
    protected $senderLastName;
    protected $receiverFirstName;
    protected $receiverLastName;
    
    public function initiatePayment(Request $request)

    {
        
        // Retrieve sender and receiver details from the request
        $this->customer = Customer::find($request->input('sender_id'));
        $this->receiver = Beneficiary::find($request->input('recever_id'));
       
        $this->senderFirstName = $this->customer->first_name;
        $this->senderLastName = $this->customer->surname;
        $this->receiverFirstName = $this->receiver->rec_first_name;;
        $this->receiverLastName =$this->receiver->rec_surname;

       
      


        
        // Add other necessary payment details here

        // Retrieve the token
        $username = env('PEOPLES_OWN_USERNAME');
        $password = env('PEOPLES_OWN_PASSWORD');

       
        $tokenResponse = $this->issueToken($username, $password);

        

        // Extract the access token from the response
        if (isset($tokenResponse['access_token'])) {
            $accessToken = $tokenResponse['access_token'];
        } else {
            return response()->json(['error' => 'Unable to retrieve access token'], 400);
        }

        // Perform AML searches for sender and receiver using the access token
        $senderSearchResponse = $this->performSearch($accessToken,$this->senderFirstName, $this->senderLastName);
        $receiverSearchResponse = $this->performSearch($accessToken,$this->receiverFirstName, $this->receiverLastName);

        // Check AML search responses for both sender and receiver
        if ($this->isAmlClear($senderSearchResponse) && $this->isAmlClear($receiverSearchResponse)) {
            // Both AML checks passed, proceed with the payment process
           return $this->processPayment($request);

           
        } else {
            
            // AML check failed for either sender or receiver, handle accordingly
           
             return $this->proceedRequest( $request  );
            
        
        }
    }

    private function issueToken($username, $password)
    {
        $response = Http::withHeaders([
            'x-api-key' => env('API_KEY'),
            'Authorization' => 'Basic ' . base64_encode($username . ':' . $password),
        ])->post('https://staging.bridger.lexisnexis.eu/LN.WebServices/api/Token/Issue');

        return $response->json(); 
    }

    private function performSearch($accessToken, $firstName, $lastName)
    {
        $response = Http::withHeaders([
            'X-API-Key' => '3987fae8-4c42-45f4-8ce2-4a082787bdc8',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post('https://staging.bridger.lexisnexis.eu/LN.WebServices/api/Lists/Search', [
            'ClientContext' => [
                'ClientReference' => 'b4d20548-20b0-46d0-b37b-172fe0a47283',
            ],
            'SearchConfiguration' => [
                'AssignResultTo' => [
                    'Division' => 'Default division',
                    'EmailNotification' => 'true',
                    'RolesOrUsers' => [
                        'Administrator',
                    ],
                    'Type' => 'Role',
                ],
                'PredefinedSearchName' => 'List Screening',
                'WriteResultsToDatabase' => 'true',
                'ExcludeScreeningListMatches' => 'false',
                'DuplicateMatchSuppression' => 'false',
                'DuplicateMatchSuppressionSameDivisionOnly' => 'false',
            ],
            'SearchInput' => [
                'Records' => [
                    [
                        'Entity' => [
                            'EntityType' => 'Individual',
                            'Name' => [
                                'First' => $firstName,
                                'Last' => $lastName,
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        return $response->json(); // Return the search response as JSON
    }

    private function isAmlClear($searchResponse)
    {
        // Check if the search response contains any matches
        if (isset($searchResponse['Records'])) {
            foreach ($searchResponse['Records'] as $record) {
                if (!empty($record['Watchlist']['Matches'])) {
                    return false; // Match found, AML check failed
                }
            }
        } else {
            // Records array not found, consider AML check passed (empty response)
            return true;
        }
    
        // No matches found, AML check passed
        return true;
    }
    

    private function pr0ocessPayment(Request $request)
    {
        // Your existing payment processing logic...

        // Example payment response
        return [
            'status' => 'success',
            'message' => 'Payment processed successfully',
        ];
    }
    public function proceedRequest(Request $request)
    
    {
      
        
        $sender = Customer::find($request->input('sender_id'));
        $receiver = Beneficiary::find($request->input('recever_id')); 
        $amount = $request->input('principal_amount');
     
        $source_of_income = $request->input('source_of_income');
        $purpose_of_payment = $request->input('purpose_of_payment');

        
        
    
        return view('crossboarder.on_payment', compact('sender', 'receiver', 'amount', 'source_of_income', 'purpose_of_payment'));
        
    }
    

    private function processPayment(Request $request )
    {
       
    
        
                    
        
        $transactionReference = $this->generateTransactionReference();     

            $consumerKey = 'ZIyOOKEIuu0Qt8TZgRGFA53Hzep4e9ZH33ICsaB65d4389b8!fabc03b54a14477da2e5503c41e2b3b60000000000000000';
            $oauthKeyPath = 'POSB-ENCRYPTION-sandbox-signing.p12';
            $keyalias = 'keyalias';
            $keystorepassword = 'tkay@jehu2024';

            $encKeyPath = 'mastercard-cross-border-services-clientenc1707460268835-client-encryption-key.pem';
            $decKeyPath = 'mastercard-cross-border-services-keyalias-mastercard-encryption-key.p12';
            $decKeyAlias = 'keyalias';
            $decKeyStorePassword = 'tkay@jehu2024';
            // …
            $signingKey = AuthenticationUtils::loadSigningKey(
                            $oauthKeyPath,
                            $keyalias, 
                            $keystorepassword);
                            
            $decryptionKey = EncryptionUtils::loadDecryptionKey(
                                                $decKeyPath, 
                                                $decKeyAlias, 
                                                $decKeyStorePassword);
                                                
            // …
            $encryptionCertificate = EncryptionUtils::loadEncryptionCertificate($encKeyPath);

            // …
            $config = JweConfigBuilder::aJweEncryptionConfig()
                ->withEncryptionCertificate($encryptionCertificate)
                ->withDecryptionKey($decryptionKey)
                ->withEncryptionPath('$', '$.encrypted_payload')
                ->withDecryptionPath('$.encrypted_payload.data', '$')
                ->withEncryptedValueFieldName('data')
                ->build();
        
                function getGUID2(){
                    if (function_exists('com_create_guid')){
                        return com_create_guid();
                    }
                    else {
                        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
                        $charid = strtoupper(md5(uniqid(rand(), true)));
                        $hyphen = chr(45);// "-"
                        $uuid = chr(123)// "{"
                            .substr($charid, 0, 8).$hyphen
                            .substr($charid, 8, 4).$hyphen
                            .substr($charid,12, 4).$hyphen
                            .substr($charid,16, 4).$hyphen
                            .substr($charid,20,12)
                            .chr(125);// "}"
                        return $uuid;
                    }
                }
      

        // Define your Mastercard credentials and endpoint
        // $consumerKey = 'ZIyOOKEIuu0Qt8TZgRGFA53Hzep4e9ZH33ICsaB65d4389b8!fabc03b54a14477da2e5503c41e2b3b60000000000000000';
        // $uri = 'https://sandbox.api.mastercard.com/send/v1/partners/BEL_MASEND5ged2/crossborder/payment';
        // $method = 'POST';

        // Create an associative array with the JSON data
      
       
        $customer = Customer::find($request->input('sender_id'));
        $receiver = Beneficiary::find($request->input('recever_id'));
        $purpose_of_payment = $request->input('purpose_of_payment');
        $source_of_income = $request->input('source_of_income');
        $principalAmount = $request->input('principal_amount');

if (!is_numeric($principalAmount) || $principalAmount <= 0) {
    return redirect()->back()->with('error', 'Invalid transaction amount')->withInput();
}

        

                $senderPhoneNumber = $customer->phone_number;

                // Define limits
                $weeklyLimit = 5000;
                $monthlyLimit = 20000;
                $yearlyLimit = 50000;


                
              // Function to get the date of the last transaction within the last 7 and 31 days
function getLastTransactionDate($phoneNumber, $days) {
   
    $startDate = Carbon::now()->subDays($days);
    return Sendmoney::where('sender_account_uri', 'LIKE', "%$phoneNumber%")
                      ->where('created_at', '>=', $startDate)
                      ->orderBy('created_at', 'desc')
                      ->first();
}

function getTransactionTotal($phoneNumber, $startDate) {
    // Assuming you have a Transaction model that has a 'created_at' column
    return Sendmoney::where('sender_account_uri',  'LIKE', "%$phoneNumber%")
                      ->where('created_at', '>=', $startDate)
                      ->sum('amountsent');
}
// Retrieve the last transaction date
$lastTransaction7Days = getLastTransactionDate($senderPhoneNumber, 7);
$lastTransaction31Days = getLastTransactionDate($senderPhoneNumber, 31);

// Calculate the next eligible transaction dates
$nextEligibleDate7Days = $lastTransaction7Days ? Carbon::parse($lastTransaction7Days->created_at)->addDays(7) : Carbon::now();
$nextEligibleDate31Days = $lastTransaction31Days ? Carbon::parse($lastTransaction31Days->created_at)->addDays(31) : Carbon::now();

// Calculate the number of days left
$daysLeftForNextWeek = $nextEligibleDate7Days->isFuture() ? Carbon::now()->diffInDays($nextEligibleDate7Days) : 0;
$daysLeftForNextMonth = $nextEligibleDate31Days->isFuture() ? Carbon::now()->diffInDays($nextEligibleDate31Days) : 0;

// Calculate total transaction amounts for the last 7 days, 31 days, and the current year
$weeklyTotal = getTransactionTotal($senderPhoneNumber, Carbon::now()->subDays(7));

$monthlyTotal = getTransactionTotal($senderPhoneNumber, Carbon::now()->subDays(31));
$yearlyTotal = getTransactionTotal($senderPhoneNumber, Carbon::now()->startOfYear());

// Check if any limit is exceeded
$exceededAmount = 0;
$limitExceeded = false;
$errorMessage = '';
if ($principalAmount > $weeklyLimit) {
    $exceededAmount = $principalAmount - $weeklyLimit;
    $limitExceeded = true;
    if ($daysLeftForNextWeek == 0) {
        $errorMessage = 'Transaction exceeds weekly sender limit by ' . $exceededAmount . '. You can perform any transactions tomorrow.';
    } else {
        $errorMessage = 'Transaction exceeds weekly sender limit by ' . $exceededAmount . '. You have ' . $daysLeftForNextWeek . ' days left until you can perform another transaction.';
    }
} elseif ($weeklyTotal + $principalAmount > $weeklyLimit) {
    $exceededAmount = ($weeklyTotal + $principalAmount) - $weeklyLimit;
    $limitExceeded = true;
    if ($daysLeftForNextWeek == 0) {
        $errorMessage = 'Transaction exceeds weekly sender limit by ' . $exceededAmount . '. You can perform any transactions tomorrow.';
    } else {
        $errorMessage = 'Transaction exceeds weekly sender limit by ' . $exceededAmount . '. You have ' . $daysLeftForNextWeek . ' days left until you can perform another transaction.';
    }
} elseif ($monthlyTotal + $principalAmount > $monthlyLimit) {
    $exceededAmount = ($monthlyTotal + $principalAmount) - $monthlyLimit;
    $limitExceeded = true;
    if ($daysLeftForNextMonth == 0) {
        $errorMessage = 'Transaction exceeds monthly sender limit by ' . $exceededAmount . '. You can perform any transactions tomorrow.';
    } else {
        $errorMessage = 'Transaction exceeds monthly sender limit by ' . $exceededAmount . '. You have ' . $daysLeftForNextMonth . ' days left until you can perform another transaction.';
    }
} elseif ($yearlyTotal + $principalAmount > $yearlyLimit) {
    $exceededAmount = ($yearlyTotal + $principalAmount) - $yearlyLimit;
    $limitExceeded = true;
    $errorMessage = 'Transaction exceeds yearly sender limit by ' . $exceededAmount . '.';
}


if ($limitExceeded) {
    return redirect('/crossboader-payment')->with('error', $errorMessage);
}

// Function to calculate the total transaction amount from a given start date
       
            if ($customer && $receiver ) {
               
            
                $senderFirstName = $customer->first_name;
                $senderLastName = $customer->surname;
                $senderDateofBirth = $customer->date_of_birth;
                $sender_house_number = $customer->house_number;
                $sender_address_area = $customer->area;
                $sender_sender_city = $customer->city; 
                $sender_phone_number= $customer->phone_number;  
                $sender_id= $customer->id_number;
               
              

                $recipientFirstName = $receiver->rec_first_name;
                $recipientLastName = $receiver->rec_surname;
                $receiver_house_number = $receiver->rec_house_number;
                $receiver_address_area = $receiver->rec_area;
                $receiver_sender_city = $receiver->rec_city;
                $receiver_phone = $receiver->recipient_account_uri;
                $receivecurrecny = $receiver->currency;
                $amount = $request->input('amount');
                $receiver_id =$receiver->rec_idc;
                $receiver_email = $receiver->rec_email;
                $gender = $receiver->gender;
              
               
                
                $allowedCountryCodes3 =['MWI','MOZ','ZMB'];
                $allowedCountryCodes4 =['HKG','SGP','MYS'];	
               
            
               
                $allowedCountryCodes6 =['AUS','CAN'];
                


                	
	
                $sepaCountryCodes = [
                    'POL',//Poland
                    'CHE',//Switzerland
                    'GBR', //United Kingdom 
                    'ADO', // Andorra
                    'AUT', // Austria
                    'BEL', // Belgium
                    'HRV', // Croatia
                    'CYP', // Cyprus
                    'EST', // Estonia
                    'FIN', // Finland
                    'FRA', // France
                    'DEU', // Germany
                    'GRC', // Greece
                    'IRL', // Ireland
                    'ITA', // Italy
                    'LVA', // Latvia
                    'LTU', // Lithuania
                    'LUX', // Luxembourg
                    'MLT', // Malta
                    'MCO', // Monaco
                    'NLD', // Netherlands
                    'PRT', // Portugal
                    'SMR', // San Marino
                    'SVK', // Slovak Republic
                    'SVN', // Slovenia
                    'ESP', // Spain
                    'VAT', // Vatican City
                ];
                
                
                  
                
                if (in_array($receiver->fxrate->country_code, [ 'IND'])) {
                    dd($receiver->payment_method);
                    
                    if ($receiver->payment_method == "BD"){
                        $paymentRequestData = [
                            "paymentrequest" => [
                                "transaction_reference" => $transactionReference,
                                "sender_account_uri" => "tel:+".$sender_phone_number,
                                "recipient_account_uri" =>"ban:".$receiver->rec_ban.";"."bic=".$receiver->rec_bic,
                                "card_rate_id" => $receiver->fxrate->card_rate_id,
                                "payment_amount" => [
                                    "amount" =>  $amount,
                                    "currency" => $receivecurrecny,
                                ],
                                "fx_type" => [
                                    "reverse" => [
                                        "sender_currency" => "USD"
                                    ]
                                ],
                                "sender" => [
                                    "first_name" =>  $senderFirstName,
                                    "last_name" =>  $senderLastName ,
                                    "nationality" => "ZWE",
                                    "address" => [
                                        "line1" => $sender_house_number ."". $sender_address_area,
                                        
                                        "city" => $sender_sender_city ,
                                        "country" => "ZWE",
                                    ],
                                    "government_id_uri" => $sender_id,
                                    "date_of_birth" => $senderDateofBirth
                                ],
                                "recipient" => [
                                    "first_name" => $recipientFirstName,
                                    "last_name" =>  $recipientLastName ,
                                    "address" => [
                                        "line1" => $receiver_house_number ." ". $receiver_address_area,
                                        "city" => $receiver_sender_city,
                                        
                                        "country" => $receiver->fxrate->country_code,
                                    ],
                                   
                                    "email" =>$receiver_email,
                                    "nationality" =>  $receiver->fxrate->country_code,
                                ],
    
                                "payment_origination_country" => "ZWE",
                                "purpose_of_payment" =>  $purpose_of_payment,
                                "source_of_income" => $source_of_income,
                                "payment_type" => "P2P",
                                  
                                "additional_data" => [
                                    'data_field' => [
                                       
                                        [
                                            "name" => '701',
                                            "value" => $receiver->fxrate->country_code,
                                        ],
                                       
                                    ],
                                ]
                            ],
                                
                            
                        ];

                    }elseif( $receiver->payment_method == "BD"){
                        dd($receiver->payment_method);



                    }
                    
                    
                } elseif (in_array($receiver->fxrate->country_code, [ 'PAK'])) {
                    // You may need additional conditions for Pakistan
                    if ($receiver->payment_method == "MW") {
                       
                        // Execute Cash Pick Up for Pakistan in PKR
                        $paymentRequestData = [
                            "paymentrequest" => [
                                "transaction_reference" => $transactionReference,
                                "sender_account_uri" => "tel:+".$sender_phone_number,
                                "recipient_account_uri" => "tel:+" . $receiver->recipient_account_uri,
                                "card_rate_id" => $receiver->fxrate->card_rate_id,
                                "payment_amount" => [
                                    "amount" =>   $amount,
                                    "currency" => $receivecurrecny,
                                ],
                                "fx_type" => [
                                    "reverse" => [
                                        "sender_currency" => "USD"
                                    ]
                                ],
    
                                "sender" => [
                                    "first_name" => $senderFirstName,
                                    "last_name" =>   $senderLastName ,
                                    "nationality" => "ZWE",
                                    "address" => [
                                        "line1" => $sender_house_number ."". $receiver_address_area,
                                        
                                        "city" => $sender_sender_city ,
                                        "country" => "ZWE",
                                    ],
                                    
                                ],
                                "recipient" => [
                                    "first_name" => $recipientFirstName,
                                    "last_name" =>  $recipientLastName ,
                                    
                                    "address" => [
                                        "line1" => $receiver_house_number ." ".$receiver_address_area,
                                        "city" => $receiver_sender_city,
                                        "country_subdivision" =>$receiver->rec_country_subdivision,
                                        "country" =>$receiver->fxrate->country_code,
                                        "postal_code" => $receiver->rec_postal_code,
                                    ],
                                   
                                   
                                    "nationality" => $receiver->fxrate->country_code,
                                   
                                ],
    
                                "payment_origination_country" => "ZWE",
                                "purpose_of_payment" =>  $purpose_of_payment,
                                "source_of_income" => $source_of_income,
                                "payment_type" => "P2P",
                                
                            ]
                        ];
                    } elseif ($receiver->payment_method == "BD") {
                        // Execute Bank Deposit for Pakistan in PKR
                        $paymentRequestData = [
                            "paymentrequest" => [
                                "transaction_reference" => $transactionReference,
                                "sender_account_uri" => "tel:+".$sender_phone_number,
                                "recipient_account_uri" => "ban:".$receiver->rec_ban.";"."bic=".$receiver->rec_bic,
                                "card_rate_id" => $receiver->fxrate->card_rate_id,
                                "payment_amount" => [
                                    "amount" =>   $amount,
                                    "currency" => $receivecurrecny,
                                ],
                                "fx_type" => [
                                    "reverse" => [
                                        "sender_currency" => "USD"
                                    ]
                                ],
    
                                "sender" => [
                                    "first_name" => $senderFirstName,
                                    "last_name" =>   $senderLastName ,
                                    "nationality" => "ZWE",
                                    "address" => [
                                        "line1" => $sender_house_number ."". $receiver_address_area,
                                        
                                        "city" => $sender_sender_city ,
                                        "country" => "ZWE",
                                    ],
                                    
                                ],
                                "recipient" => [
                                    "first_name" => $recipientFirstName,
                                    "last_name" =>  $recipientLastName ,
                                    
                                    "address" => [
                                        "line1" => $receiver_house_number ." ".$receiver_address_area,
                                        "city" => $receiver_sender_city,
                                        "country_subdivision" =>$receiver->rec_country_subdivision,
                                        "country" =>$receiver->fxrate->country_code,
                                        "postal_code" => $receiver->rec_postal_code,
                                    ],
                                   
                                   
                                    "nationality" => $receiver->fxrate->country_code,
                                   
                                ],
    
                                "payment_origination_country" => "ZWE",
                                "purpose_of_payment" =>  $purpose_of_payment,
                                "source_of_income" => $source_of_income,
                                "payment_type" => "P2P",
                                
                            ]
                        ];
                    }
                    elseif ($receiver->payment_method == "IB") {
                        // Execute Bank Deposit for Pakistan in PKR
                        $paymentRequestData = [
                            "paymentrequest" => [
                                "transaction_reference" => $transactionReference,
                                "sender_account_uri" => "tel:+".$sender_phone_number,
                                "recipient_account_uri" => "iban:".$receiver->rec_iban,
                                "card_rate_id" => $receiver->fxrate->card_rate_id,
                                "payment_amount" => [
                                    "amount" =>   $amount,
                                    "currency" => $receivecurrecny,
                                ],
                                "fx_type" => [
                                    "reverse" => [
                                        "sender_currency" => "USD"
                                    ]
                                ],
    
                                "sender" => [
                                    "first_name" => $senderFirstName,
                                    "last_name" =>   $senderLastName ,
                                    "nationality" => "ZWE",
                                    "address" => [
                                        "line1" => $sender_house_number ."". $receiver_address_area,
                                        
                                        "city" => $sender_sender_city ,
                                        "country" => "ZWE",
                                    ],
                                    
                                ],
                                "recipient" => [
                                    "first_name" => $recipientFirstName,
                                    "last_name" =>  $recipientLastName ,
                                    
                                    "address" => [
                                        "line1" => $receiver_house_number ." ".$receiver_address_area,
                                        "city" => $receiver_sender_city,
                                        "country_subdivision" =>$receiver->rec_country_subdivision,
                                        "country" =>$receiver->fxrate->country_code,
                                        "postal_code" => $receiver->rec_postal_code,
                                    ],
                                   
                                   
                                    "nationality" => $receiver->fxrate->country_code,
                                   
                                ],
    
                                "payment_origination_country" => "ZWE",
                                "purpose_of_payment" =>  $purpose_of_payment,
                                "source_of_income" => $source_of_income,
                                "payment_type" => "P2P",
                                
                            ]
                        ];
                    }
                } elseif (in_array($receiver->fxrate->country_code, [ 'ZMB'])) {
                    
                    if ($receiver->payment_method == "BD") {
                        $paymentRequestData = [
                            "paymentrequest" => [
                                "transaction_reference" => $transactionReference,
                                "sender_account_uri" => "tel:+".$sender_phone_number,
                                "recipient_account_uri" => "ban:".$receiver->rec_ban.";"."bic=".$receiver->rec_bic,
                                "card_rate_id" => $receiver->fxrate->card_rate_id,
                                "payment_amount" => [
                                    "amount" =>   $amount,
                                    "currency" => $receivecurrecny,
                                ],
                                "fx_type" => [
                                    "reverse" => [
                                        "sender_currency" => "USD"
                                    ]
                                ],
    
                                "sender" => [
                                    "first_name" => $senderFirstName,
                                    "last_name" =>   $senderLastName ,
                                    "nationality" => "ZWE",
                                    "address" => [
                                        "line1" => $sender_house_number ."". $receiver_address_area,
                                        
                                        "city" => $sender_sender_city ,
                                        "country" => "ZWE",
                                    ],
                                    
                                ],
                                "recipient" => [
                                    "first_name" => $recipientFirstName,
                                    "last_name" =>  $recipientLastName ,
                                    
                                    "address" => [
                                        "line1" => $receiver_house_number ." ".$receiver_address_area,
                                        "city" => $receiver_sender_city,
                                        "country_subdivision" =>$receiver->rec_country_subdivision,
                                        "country" =>$receiver->fxrate->country_code,
                                        "postal_code" => $receiver->rec_postal_code,
                                    ],
                                   
                                   
                                    "nationality" => $receiver->fxrate->country_code,
                                   
                                ],
    
                                "payment_origination_country" => "ZWE",
                                "purpose_of_payment" =>  $purpose_of_payment,
                                "source_of_income" => $source_of_income,
                                "payment_type" => "P2P",
                                
                            ]
                        ];


                        
                    } elseif ($receiver->payment_method == "MW") {
                        $paymentRequestData = [
                            "paymentrequest" => [
                                "transaction_reference" => $transactionReference,
                                "sender_account_uri" => "tel:+".$sender_phone_number,
                                "recipient_account_uri" => "tel:+" . $receiver->recipient_account_uri,
                                "card_rate_id" => $receiver->fxrate->card_rate_id,
                                "payment_amount" => [
                                    "amount" =>   $amount,
                                    "currency" => $receivecurrecny,
                                ],
                                "fx_type" => [
                                    "reverse" => [
                                        "sender_currency" => "USD"
                                    ]
                                ],
    
                                "sender" => [
                                    "first_name" => $senderFirstName,
                                    "last_name" =>   $senderLastName ,
                                    "nationality" => "ZWE",
                                    "address" => [
                                        "line1" => $sender_house_number ."". $receiver_address_area,
                                        
                                        "city" => $sender_sender_city ,
                                        "country" => "ZWE",
                                    ],
                                    
                                ],
                                "recipient" => [
                                    "first_name" => $recipientFirstName,
                                    "last_name" =>  $recipientLastName ,
                                    
                                    "address" => [
                                        "line1" => $receiver_house_number ." ".$receiver_address_area,
                                        "city" => $receiver_sender_city,
                                        "country_subdivision" =>$receiver->rec_country_subdivision,
                                        "country" =>$receiver->fxrate->country_code,
                                        "postal_code" => $receiver->rec_postal_code,
                                    ],
                                   
                                   
                                    "nationality" => $receiver->fxrate->country_code,
                                   
                                ],
    
                                "payment_origination_country" => "ZWE",
                                "purpose_of_payment" =>  $purpose_of_payment,
                                "source_of_income" => $source_of_income,
                                "payment_type" => "P2P",
                                
                            ]
                        ];
                        
                    }
                } 

                elseif (in_array($receiver->fxrate->country_code, [ 'ZAF'])) {
                    // Construct the payment data for South Africa and USA
                    
                    $paymentRequestData = [
                        "paymentrequest" => [
                            "transaction_reference" => $transactionReference,
                            "sender_account_uri" => "tel:+".$sender_phone_number,
                            "recipient_account_uri" =>"ban:".$receiver->rec_ban.";"."bic=".$receiver->rec_bic,
                            "card_rate_id" => $receiver->fxrate->card_rate_id,
                            "payment_amount" => [
                                "amount" =>  $amount,
                                "currency" => $receivecurrecny,
                            ],
                            "fx_type" => [
                                "reverse" => [
                                    "sender_currency" => "USD"
                                ]
                            ],
                            "sender" => [
                                "first_name" =>  $senderFirstName,
                                "last_name" =>  $senderLastName ,
                                "nationality" => "ZWE",
                                "address" => [
                                    "line1" => $sender_house_number ."". $sender_address_area,
                                    
                                    "city" => $sender_sender_city ,
                                    "country" => "ZWE",
                                ],
                                "government_id_uri" => $sender_id,
                                "date_of_birth" => $senderDateofBirth
                            ],
                            "recipient" => [
                                "first_name" => $recipientFirstName,
                                "last_name" =>  $recipientLastName ,
                                "address" => [
                                    "line1" => $receiver_house_number ." ". $receiver_address_area,
                                    "city" => $receiver_sender_city,
                                    
                                    "country" => $receiver->fxrate->country_code,
                                ],
                               
                                "email" =>$receiver_email,
                                "nationality" =>  $receiver->fxrate->country_code,
                            ],

                            "payment_origination_country" => "ZWE",
                            "purpose_of_payment" =>  $purpose_of_payment,
                            "source_of_income" => $source_of_income,
                            "payment_type" => "P2P",
                              
                            "additional_data" => [
                                'data_field' => [
                                   
                                    [
                                        "name" => '701',
                                        "value" => $receiver->fxrate->country_code,
                                    ],
                                   
                                ],
                            ]
                        ],
                            
                        
                    ];

                } elseif (in_array($receiver->fxrate->country_code, $allowedCountryCodes4)) {
                    // United State Of America
                    
                    $paymentRequestData = [
                        "paymentrequest" => [
                            "transaction_reference" => $transactionReference,
                            "sender_account_uri" => "tel:+".$sender_phone_number,
                            "recipient_account_uri" =>"ban:".$receiver->rec_ban.";"."bic=".$receiver->rec_bic,
                            "card_rate_id" => $receiver->fxrate->card_rate_id,
                            "payment_amount" => [
                                "amount" =>  $amount,
                                "currency" => $receivecurrecny,
                            ],
                            "fx_type" => [
                                "reverse" => [
                                    "sender_currency" => "USD"
                                ]
                            ],
                            "sender" => [
                                "first_name" =>  $senderFirstName,
                                "last_name" =>  $senderLastName ,
                                "nationality" => "ZWE",
                                "address" => [
                                    "line1" => $sender_house_number ."". $receiver_address_area,
                                    
                                    "city" => $sender_sender_city ,
                                    "country" => "ZWE",
                                ],
                               
                                "date_of_birth" => $senderDateofBirth
                            ],
                            "recipient" => [
                                "first_name" => $recipientFirstName,
                                "last_name" =>  $recipientLastName ,
                                "address" => [
                                    "line1" => $receiver_house_number ." ".$receiver_address_area,
                                    "city" => $receiver_sender_city,
                                    
                                    "country" => $receiver->fxrate->country_code,
                                    
                                ],
                                
                            
                                "nationality" =>  $receiver->fxrate->country_code,
                               
                            ],

                          
                            
                           
                            "payment_type" => "P2P",
                            "source_of_income" => $source_of_income,
                            "purpose_of_payment" =>  $purpose_of_payment,    
                            "payment_origination_country" => "ZWE",  
                            "additional_data" => [
                                'data_field' => [
                                   
                                    [
                                        "name" => '701',
                                        "value" => $receiver->fxrate->country_code,
                                    ],
                                   
                                ],
                            ]
                        ]
                    ];
                }
                elseif (in_array($receiver->fxrate->country_code, ['USA'])) {
                    // United State Of America
                    
                    $paymentRequestData = [
                        "paymentrequest" => [
                            "transaction_reference" => $transactionReference,
                            "sender_account_uri" => "tel:+".$sender_phone_number,
                            "recipient_account_uri" =>"ban:".$receiver->rec_ban.";"."bic=".$receiver->rec_bic,
                            "card_rate_id" => $receiver->fxrate->card_rate_id,
                            "payment_amount" => [
                                "amount" =>  $amount,
                                "currency" => $receivecurrecny,
                            ],
                            "fx_type" => [
                                "reverse" => [
                                    "sender_currency" => "USD"
                                ]
                            ],
                            "sender" => [
                                "first_name" =>  $senderFirstName,
                                "last_name" =>  $senderLastName ,
                                "nationality" => "ZWE",
                                "address" => [
                                    "line1" => $sender_house_number ."". $receiver_address_area,
                                    
                                    "city" => $sender_sender_city ,
                                    "country" => "ZWE",
                                ],
                               
                                "date_of_birth" => $senderDateofBirth
                            ],
                            "recipient" => [
                                "first_name" => $recipientFirstName,
                                "last_name" =>  $recipientLastName ,
                                "address" => [
                                    "line1" => $receiver_house_number ." ".$receiver_address_area,
                                    "city" => $receiver_sender_city,
                                    "country_subdivision" =>$receiver->rec_country_subdivision,
                                    "country" => $receiver->fxrate->country_code,
                                    "postal_code" => $receiver->rec_postal_code,
                                ],
                                
                            
                                "nationality" =>  $receiver->fxrate->country_code,
                               
                            ],

                          
                            
                           
                            "payment_type" => "P2P",
                            "source_of_income" => $source_of_income,
                            "purpose_of_payment" =>  $purpose_of_payment,
                            "receiving_bank_name" => $receiver->rec_bank_name,    
                            "payment_origination_country" => "ZWE",  
                            "additional_data" => [
                                'data_field' => [
                                   
                                    [
                                        "name" => '701',
                                        "value" => $receiver->fxrate->country_code,
                                    ],
                                    [
                                        "name" => '630',
                                        "value" => $receiver->rec_bank_type,
                                    ],
                                ],
                            ]
                        ]
                    ];
                }
                elseif (in_array($receiver->fxrate->country_code,["JPN"])) {
                   
                    
                    $paymentRequestData = [
                        "paymentrequest" => [
                            "transaction_reference" => $transactionReference,
                            "sender_account_uri" => "tel:+".$sender_phone_number,
                            "recipient_account_uri" =>"ban:".$receiver->rec_ban.";"."bic=".$receiver->rec_bic,
                            "card_rate_id" => $receiver->fxrate->card_rate_id,
                            "payment_amount" => [
                                "amount" =>  $amount,
                                "currency" => $receivecurrecny,
                            ],
                            "fx_type" => [
                                "reverse" => [
                                    "sender_currency" => "USD"
                                ]
                            ],
                            "sender" => [
                                "first_name" =>  $senderFirstName,
                                "last_name" =>  $senderLastName ,
                                "nationality" => "ZWE",
                                "address" => [
                                    "line1" => $sender_house_number ."". $receiver_address_area,
                                    
                                    "city" => $sender_sender_city ,
                                    "country" => "ZWE",
                                ],
                               
                               
                            ],
                            "recipient" => [
                                "first_name" => $recipientFirstName,
                                "last_name" =>  $recipientLastName ,
                                "address" => [
                                    "line1" => $receiver_house_number ." ".$receiver_address_area,
                                    "city" => $receiver_sender_city,
                                
                                    "country" => $receiver->fxrate->country_code,
                                 
                                ],
                                
                            
                                "nationality" =>  $receiver->fxrate->country_code,
                               
                            ],

                          
                            
                           
                            "payment_type" => "P2P",
                            "source_of_income" => $source_of_income,
                            "purpose_of_payment" =>  $purpose_of_payment,
                              
                            "payment_origination_country" => "ZWE",
                            "bank_code"=> $receiver->rec_bank_code,
                            "additional_data" => [
                                'data_field' => [
                                   
                                    [
                                        "name" => '701',
                                        "value" => $receiver->fxrate->country_code,
                                    ],
                                   
                                  
                                    [
                                        "name" => '630',
                                        "value" => $receiver->rec_bank_type,
                                    ],
        
                                ],
                            ]
                        ]
                    ];
                }
                
                
                elseif (in_array($receiver->fxrate->country_code, $allowedCountryCodes6)) {
                   
                    
                    $paymentRequestData = [
                        "paymentrequest" => [
                            "transaction_reference" => $transactionReference,
                            "sender_account_uri" => "tel:+".$sender_phone_number,
                            "recipient_account_uri" =>"ban:".$receiver->rec_ban.";"."bic=".$receiver->rec_bic,
                            "card_rate_id" => $receiver->fxrate->card_rate_id,
                            "payment_amount" => [
                                "amount" =>  $amount,
                                "currency" => $receivecurrecny,
                            ],
                            "fx_type" => [
                                "reverse" => [
                                    "sender_currency" => "USD"
                                ]
                            ],
                            "sender" => [
                                "first_name" =>  $senderFirstName,
                                "last_name" =>  $senderLastName ,
                                "nationality" => "ZWE",
                                "address" => [
                                    "line1" => $sender_house_number ."". $receiver_address_area,
                                    
                                    "city" => $sender_sender_city ,
                                    "country" => "ZWE",
                                ],
                               
                                "date_of_birth" => $senderDateofBirth
                            ],
                            "recipient" => [
                                "first_name" => $recipientFirstName,
                                "last_name" =>  $recipientLastName ,
                                "address" => [
                                    "line1" => $receiver_house_number ." ".$receiver_address_area,
                                    "city" => $receiver_sender_city,
                                
                                    "country" => $receiver->fxrate->country_code,
                                 
                                ],
                                
                            
                                "nationality" =>  $receiver->fxrate->country_code,
                               
                            ],

                          
                            
                           
                            "payment_type" => "P2P",
                            "source_of_income" => $source_of_income,
                            "purpose_of_payment" =>  $purpose_of_payment,
                              
                            "payment_origination_country" => "ZWE",
                            "bank_code"=> $receiver->rec_bank_code,
                            "additional_data" => [
                                'data_field' => [
                                   
                                    [
                                        "name" => '701',
                                        "value" => $receiver->fxrate->country_code,
                                    ],
                                   
                                ],
                            ]
                        ]
                    ];
                }
                elseif (in_array($receiver->fxrate->country_code, ['THA'])) {
                    // Construct the payment data for Thailand
                    
                    $paymentRequestData = [
                        "paymentrequest" => [
                            "transaction_reference" => $transactionReference,
                            "sender_account_uri" => "tel:+".$sender_phone_number,
                            "recipient_account_uri" =>"ban:".$receiver->rec_ban.";"."bic=".$receiver->rec_bic,
                            "card_rate_id" => $receiver->fxrate->card_rate_id,
                            "payment_amount" => [
                                "amount" =>  $amount,
                                "currency" => $receivecurrecny,
                            ],
                            "fx_type" => [
                                "reverse" => [
                                    "sender_currency" => "USD"
                                ]
                            ],
                            "sender" => [
                                "first_name" =>  $senderFirstName,
                                "last_name" =>  $senderLastName ,
                                "nationality" => "ZWE",
                                "address" => [
                                    "line1" => $sender_house_number ."". $receiver_address_area,
                                    
                                    "city" => $sender_sender_city ,
                                    "country" => "ZWE",
                                ],
                                "government_id_uri" => $sender_id,
                                "date_of_birth" => $senderDateofBirth
                            ],
                            "recipient" => [
                                "first_name" => $recipientFirstName,
                                "last_name" =>  $recipientLastName ,
                                "address" => [
                                    "line1" => $receiver_house_number ." ".$receiver_address_area,
                                    "city" => $receiver_sender_city,
                                    
                                    "country" => $receiver->fxrate->country_code,
                                  
                                ],
                                "email" =>$receiver_email,
                             
                                "nationality" =>  $receiver->fxrate->country_code,
                                
                            ],

                            "payment_origination_country" => "ZWE",
                            "purpose_of_payment" =>  $purpose_of_payment,
                            "source_of_income" => $source_of_income,
                            "payment_type" => "P2P",
                            
                            "additional_data" => [
                                'data_field' => [
                                   
                                    [
                                        "name" => '701',
                                        "value" => $receiver->fxrate->country_code,
                                    ],
                                    
                                ],
                               
                             ]    
                        ] 
                    ];
                }
                 elseif (in_array($receiver->fxrate->country_code, $sepaCountryCodes)) {
                    // Construct the payment data for SEPA
                    $paymentRequestData = [
                        "paymentrequest" => [
                            "transaction_reference" => $transactionReference,
                            "sender_account_uri" => "tel:+".$sender_phone_number,
                            "recipient_account_uri" =>"iban:".$receiver->rec_iban,
                            "card_rate_id" => $receiver->fxrate->card_rate_id,
                            "payment_amount" => [
                                "amount" =>  $amount,
                                "currency" => $receivecurrecny,
                            ],
                            "fx_type" => [
                                "reverse" => [
                                    "sender_currency" => "USD"
                                ]
                            ],
                            "sender" => [
                                "first_name" => $senderFirstName,
                                "last_name" =>   $senderLastName ,
                                "nationality" => "ZWE",
                                "address" => [
                                    "line1" => $sender_house_number ."". $receiver_address_area,
                                    
                                    "city" => $sender_sender_city ,
                                    "country" => "ZWE",
                                ],
                                
                                "date_of_birth" =>$senderDateofBirth
                            ],
                            "recipient" => [
                                "first_name" => $recipientFirstName,
                                "last_name" =>  $recipientLastName ,
                                "address" => [
                                    "line1" => $receiver_house_number ." ".$receiver_address_area,
                                    "city" => $receiver_sender_city,
                                    "country_subdivision" =>$receiver->rec_country_subdivision,
                                    "country" =>$receiver->fxrate->country_code,
                                    "postal_code" => $receiver->rec_postal_code,
                                ],
                               
                                
                                "nationality" => $receiver->fxrate->country_code,
                               
                            ],

                            "payment_origination_country" => "ZWE",
                            "purpose_of_payment" =>  $purpose_of_payment,
                            "source_of_income" => $source_of_income,
                            "payment_type" => "P2P",
                            "additional_data" => [
                                'data_field' => [
                                   
                                    [
                                        "name" => '701',
                                        "value" => $receiver->fxrate->country_code,
                                    ],
                                   
                                ],
                            ]
                        ],
                            
                            
                        
                    ];
                } elseif (in_array($receiver->fxrate->country_code, $allowedCountryCodes3)) {
                    // Construct the payment data for Moza, Zambai and Malawi
                    $paymentRequestData = [
                        "paymentrequest" => [
                            "transaction_reference" => $transactionReference,
                            "sender_account_uri" => "tel:+".$sender_phone_number,
                            "recipient_account_uri" =>"tel:+".$receiver->recipient_account_uri,
                            "card_rate_id" => $receiver->fxrate->card_rate_id,
                            "payment_amount" => [
                                "amount" =>   $amount,
                                "currency" => $receivecurrecny,
                            ],
                            "fx_type" => [
                                "reverse" => [
                                    "sender_currency" => "USD"
                                ]
                            ],

                            "sender" => [
                                "first_name" => $senderFirstName,
                                "last_name" =>   $senderLastName ,
                                "nationality" => "ZWE",
                                "address" => [
                                    "line1" => $sender_house_number ."". $receiver_address_area,
                                    
                                    "city" => $sender_sender_city ,
                                    "country" => "ZWE",
                                ],
                                
                            ],
                            "recipient" => [
                                "first_name" => $recipientFirstName,
                                "last_name" =>  $recipientLastName ,
                                "phone"=> $receiver_phone,
                                "address" => [
                                    "line1" => $receiver_house_number ." ".$receiver_address_area,
                                    "city" => $receiver_sender_city,
                                    "country_subdivision" =>$receiver->rec_country_subdivision,
                                    "country" =>$receiver->fxrate->country_code,
                                    "postal_code" => $receiver->rec_postal_code,
                                ],
                               
                               
                                "nationality" => $receiver->fxrate->country_code,
                               
                            ],

                            "payment_origination_country" => "ZWE",
                            "purpose_of_payment" =>  $purpose_of_payment,
                            "source_of_income" => $source_of_income,
                            "payment_type" => "P2P",   
                        ]
                    ];
                }elseif (in_array($receiver->fxrate->country_code, ['CHN'])) {
                  
                    
                    $paymentRequestData = [
                        "paymentrequest" => [
                            "transaction_reference" => $transactionReference,
                            "sender_account_uri" => "tel:+".$sender_phone_number,
                            "recipient_account_uri" => "pan:".$receiver->rec_pan,
                            "card_rate_id" => $receiver->fxrate->card_rate_id,
                            "payment_amount" => [
                                "amount" =>   $amount,
                                "currency" => $receiver->fxrate,

                               
                            ],
                            "fx_type" => [
                                "reverse" => [
                                    "sender_currency" => "USD"
                                ]
                            ],

                            "sender" => [
                                "first_name" => $senderFirstName,
                                "last_name" =>   $senderLastName,
                                "nationality" => "ZWE",
                                "address" => [
                                    "line1" => $sender_house_number ."". $receiver_address_area,
                                    
                                    "city" => $sender_sender_city,
                                    "country" => "ZWE",
                                ],
                                
                            ],
                            "recipient" => [
                                "first_name" => $recipientFirstName,
                                "last_name" => $recipientLastName,
                            
                                "address" => [
                                    "line1" => $receiver_house_number . " " . $receiver_address_area,
                                    "city" => $receiver_sender_city,
                                    "country_subdivision" => $receiver->rec_country_subdivision,
                                    "country" => $receiver->fxrate->country_code,
                                    "postal_code" => $receiver->rec_postal_code,
                                ],
                            
                                "government_ids[]" => [
                                    [
                                        "government_id_uri" => $receiver->idc,
                                    ],
                                ],
                            
                                "nationality" => $receiver->fxrate->country_code,
                            ],
                            

                            "payment_origination_country" => "ZWE",
                            "purpose_of_payment" =>  $purpose_of_payment,
                            "source_of_income" => $source_of_income,
                            "payment_type" => "P2P",
                            "additional_data" => [
                                'data_field' => [
                                    [
                                        "name" => '701',
                                        "value" => $receiver->fxrate->country_code,
                                    ], 
                                ],

                            ]
                            
                        ]
                    
                    ];
                }
                elseif (in_array($receiver->fxrate->country_code, ['ARE'])) {
                    
                    $paymentRequestData = [
                        "paymentrequest" => [
                            "transaction_reference" => $transactionReference,
                            "sender_account_uri" => "tel:+".$sender_phone_number,
                            "recipient_account_uri" => "iban:".$receiver->rec_iban,
                            "card_rate_id" => $receiver->fxrate->card_rate_id,
                            "payment_amount" => [
                                "amount" =>   $amount,
                                "currency" => $receivecurrecny,
                            ],
                            "fx_type" => [
                                "reverse" => [
                                    "sender_currency" => "USD"
                                ]
                            ],

                            "sender" => [
                                "first_name" => $senderFirstName,
                                "last_name" =>   $senderLastName,
                                "nationality" => "ZWE",
                                "address" => [
                                    "line1" => $sender_house_number ."". $receiver_address_area,
                                    
                                    "city" => $sender_sender_city ,
                                    "country" => "ZWE",
                                ],
                                "government_id_uri" => $sender_id,
                                "date_of_birth" => $senderDateofBirth
                            ],
                            "recipient" => [
                                "first_name" => $recipientFirstName,
                                "last_name" =>  $recipientLastName,
                                
                                "address" => [
                                    "line1" => $receiver_house_number ." ".$receiver_address_area,
                                    "city" => $receiver_sender_city,
                                    "country_subdivision" =>$receiver->rec_country_subdivision,
                                    "country" =>$receiver->fxrate->country_code,
                                    
                                ],
                               
                                "government_id_uri" => $receiver_id,
                                "date_of_birth" => $senderDateofBirth,
                                "nationality" => $receiver->fxrate->country_code,
                               
                            ],

                            "payment_origination_country" => "ZWE",
                            "purpose_of_payment" =>  $purpose_of_payment,
                            "source_of_income" => $source_of_income,
                            "payment_type" => "P2P",
                            "additional_data" => [
                                'data_field' => [
                                    [
                                        "name" => '701',
                                        "value" => $receiver->fxrate->country_code,
                                    ], 
                                ],

                            ]
                            
                        ]
                    ];
                    
                }

                 else {
                    // Handle cases where the country code is not in any of the specified sets
                    return response()->json(['error' => 'Invalid country code'], 400);
                }

                // The rest of your code for sending the API request and handling the response




                // Now, $phpArray contains the JSON data as an associative PHP array
                
        
        
                // Convert the PHP array to a JSON string
                $requestPayload =  json_encode($paymentRequestData, JSON_PRETTY_PRINT);
                Log::info('Request to Mastercard API', [
                    'payload' => json_encode($paymentRequestData, JSON_PRETTY_PRINT)
                ]);
                // Now, you can use $payload in your API request
        
        
                				
$encryptedPayload = JweEncryption::encryptPayload($requestPayload, $config);


// …
$method = 'POST';
$uri = 'https://sandbox.api.mastercard.com/send/v1/partners/BEL_MASEND5ged2/crossborder/payment';
$payload = json_encode(json_decode($encryptedPayload), JSON_PRETTY_PRINT);
$headers = array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload),
	'x-encrypted: true'
);

function callAPI($method, $uri, $headers, $payload, $consumerKey, $signingKey){
    $handle = curl_init($uri);
	curl_setopt_array($handle, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_CUSTOMREQUEST => $method, CURLOPT_POSTFIELDS => $payload));
	$signer = new CurlRequestSigner($consumerKey, $signingKey);
	$signer->sign($handle, $method, $headers, $payload);
	$result = curl_exec($handle);
	curl_close($handle);
	return $result;
}
$result = callAPI($method, $uri, $headers, $payload, $consumerKey, $signingKey);



$result2 = JweEncryption::decryptPayload($result, $config);

$responseData = json_decode($result2, true);
Log::info('Response from Mastercard API', [
    'response' => json_encode($responseData, JSON_PRETTY_PRINT)
]);



// Check if decoding was successful
if ($responseData === null && json_last_error() !== JSON_ERROR_NONE) {
    // Handle JSON decoding error
    die('Error decoding JSON: ' . json_last_error_msg());
}
                $user = request()->user();
        
               
                $payment = new Sendmoney();
                
                // Assign sender details
                $payment->sender_first_name = $customer->first_name;
                $payment->sender_last_name = $customer->surname;
                $payment->sender_date_of_birth = $customer->date_of_birth;
                $payment->sender_house_number = $customer->house_number;
                $payment->sender_address_area = $customer->area;
                $payment->sender_city = $customer->city;
                $payment->sender_phone_number = $customer->phone_number;
                $payment->sender_id = $customer->id_number;

                // Assign recipient details
                $payment->recipient_first_name = $receiver->rec_first_name;
                $payment->recipient_last_name = $receiver->rec_surname;
                $payment->recipient_house_number = $receiver->rec_house_number;
                $payment->recipient_address_area = $receiver->rec_area;
                $payment->recipient_city = $receiver->rec_city;
                $payment->recipient_phone = $receiver->recipient_account_uri;
                $payment->receive_currency = $receiver->currency;
                $payment->amount = $request->input('amount');
                $payment->recipient_id = $receiver->rec_idc;
                $payment->recipient_email = $receiver->rec_email;
                $payment->recipient_gender = $receiver->gender;

                $payment->transaction_reference = $responseData['payment']['transaction_reference'];
                $payment->status = $responseData['payment']['status'];
                $payment->fees_amount = $responseData['payment']['fees_amount']['amount'];
                $payment->charged_amount = $responseData['payment']['charged_amount']['amount'];
                $payment->credited_amount = $responseData['payment']['credited_amount']['amount'];
                $payment->principal_amount = $responseData['payment']['principal_amount']['amount'];
                $payment->currency = $responseData['payment']['principal_amount']['currency'];
                $payment->sender_account_uri = $responseData['payment']['sender_account_uri'];
                $payment->recipient_account_uri = $responseData['payment']['recipient_account_uri'];
                $payment->payment_amount = $responseData['payment']['payment_amount']['amount'];
                $payment->payment_origination_country = $responseData['payment']['payment_origination_country'];
                $payment->fx_rate = $responseData['payment']['fx_rate'];
                $payment->amountsent = $principalAmount ;
                
                // Check if bank_code exists in $responseData before setting it
                if (isset($responseData['payment']['bank_code'])) {
                    $payment->bank_code = $responseData['payment']['bank_code'];
                } else {
                    // Handle the case where bank_code is not available
                    $payment->bank_code = null; // or set it to a default value, if necessary
                }
                
                $payment->payment_type = $responseData['payment']['payment_type'];
                $payment->source_of_income = $responseData['payment']['source_of_income'];
                $payment->settlement_details = $responseData['payment']['settlement_details']['amount'];
                $payment->cashout_code = $responseData['payment']['cashout_code'];
                $payment->created_by = $user->id;
                $payment->modified_by = $user->id;
                $payment->created_at = now();
                $payment->save();



                // Mapping array for source of funds descriptions to codes
$sourceOfFundsMap = [
    'Salary'  => 'SAL',
    'Savings' => 'SV',
    'Government funding'=> 'GF',
    'Business' => 'PN',
    'Loan' => 'PN',
    'Investments' => 'GF',
    'Personal Income' => 'SV'


];

// Example source of income description (this could come from user input, a database, etc.)
$source_of_income_description = $source_of_income; // Replace this with dynamic input as needed

// Get the corresponding code for the source of income description
$sourceOfFundsCode = $sourceOfFundsMap[$source_of_income_description] ?? null;

$purposeOfFandMap =[
    'Family Maintenance' =>	'GFT',
    'Household Maintenance'	 =>'RNT',
    'Payment of Loan'	 =>'INS',
    'Purchase of Property'  =>	'CNT',
    'Funeral Expenses'  =>	'FES',
    'Medical Expenses'  =>	'MED',
    'Wedding Expenses'  =>	'HTR',
    'Payment of bills' =>	'UTB',
    'Education' 	 =>'EDU',
    'Savings' 	 =>'GFT',
    'Employee Colleague'  =>	'GFT',
    
];

// Example source of income description (this could come from user input, a database, etc.)
$purpose_of_income_description = $purpose_of_payment ; // Replace this with dynamic input as needed

$purposeOfFundsCode = $purposeOfFandMap[$purpose_of_income_description] ?? null;

$letterCountryCode=[

'South Africa' => 'ZA',
'United States' => 'US',
'Thailand' => 'TH',
'United Kingdom' => 'GB',
'Canada' => 'CA',
'United Arab Emirates' => 'AE',
'Australia' => 'AU',
'Poland' => 'PL',
'Japan' => 'JP',
'Switzerland' => 'CH',
'Hong Kong' => 'HK',
'Singapore' => 'SG',
'Zambia' => 'ZM',
'India' => 'IN',
'Pakistan' => 'PK',
'Malaysia' => 'MY',
'China' => 'CN',
'Mozambique' => 'MZ',
'Malawi' => 'MW',
'Andorra' => 'AD',
'Austria' => 'AT',
'Belgium' => 'BE',
'Croatia' => 'HR',
'Cyprus' => 'CY',
'Estonia' => 'EE',
'Finland' => 'FI',
'France' => 'FR',
'Germany' => 'DE',
'Greece' => 'GR',
'Ireland' => 'IE',
'Italy' => 'IT',
'Latvia' => 'LV',
'Lithuania' => 'LT',
'Luxembourg' => 'LU',
'Malta' => 'MT',
'Monaco' => 'MC',
'Netherlands' => 'NL',
'Portugal' => 'PT',
'San Marino' => 'SM',

];

$country_of_income_description =$receiver->fxrate->country ; 



$countryOfFundsCode = $letterCountryCode[$country_of_income_description] ?? null;

$now = Carbon::now();
$isoDate = $now->toIso8601String();



// Parse the original date using Carbon
$carbonDate = Carbon::parse($isoDate );

// Format the Carbon date to the desired ISO 8601 format
$formattedDate = $carbonDate->toIso8601String();

$OriginalDate1 = substr($formattedDate, 0, -6) . '.025Z';
                    $data = [
                        'amount' => $principalAmount,
                        'bdxBranch' => Auth::user()->branch->branch_name,
                        'city' => $sender_sender_city,
                        'countryCode' => $countryOfFundsCode,
                        'countryName' => $receiver->fxrate->country,
                        'currencyCode' => 'USD',
                        'district' => $sender_sender_city,
                        'gender' => $gender,
                        'internationalPartnerCode' => 'PR',
                        'internationalPartnerName' => 'POSB REMIT',
                        'nationalId' => $sender_id,
                        'operatorName' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                        'originalReference' => $payment->transaction_reference,
                        'recipientName' => $recipientFirstName . " " . $recipientLastName,
                        'senderName' => $senderFirstName . " " . $senderLastName,
                        'sourceOfFundsCode' => $sourceOfFundsCode,
                        'street' => $sender_house_number . " " . $sender_address_area,
                        'suburb' => $sender_sender_city,
                        'transactionDate' => $OriginalDate1,
                        'transactionPurposeCode' => $purposeOfFundsCode,
                        'transactionType' => 'Send',
                        'transferMode' => 'CASH',
                    ];

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'X-API-Key' => 'd1dec13c-928b-422a-acaf-fc56d27dca34',
                    'x-trace-id' =>(string) Str::uuid(),

                ])->post('https://tarms.posb.co.zw:11002/api/v1/transaction/add', $data);


                Log::info('Request to mta_transaction- RBZ:', [
                    'url' => 'https://tarms.posb.co.zw:11002/api/v1/transaction/add',
                    'payload' => $data,
                ]);
                

               
              
                 // Determine the status based on the response
                $status = $response->successful() ? 'success' : 'failed';

                // Save the data with status to the database
                $data['status'] = $status;

                Transaction::create($data);
                // Log the response
                if ($response->status() < 200 || $response->status() >= 300) {
                    Log::error('Failed response from mta_transaction- RBZ :', [
                        'status' => $response->status(),
                        'body' => $response->body()
                    ]);
                    
                } else {
                    Log::info('Successful response from mta_transaction- RBZ :', [
                        'status' => $response->status(),
                        'body' => $response->body()
                    ]);
                }


                    $user = $request->user()->ethics_user;
                    

                    // Define the headers for the API request
                    $headers = [
                        'Content-Type' => 'application/json',
                        'x-api-key' => '93c5ad2a-94d1-43b9-a8ef-177329cf528a',
                        'x-trace-id' => 'POSB-REMIT' . uniqid(),
                    ];

                    // Retrieve the user
        $user = $request->user()->ethics_user;

        // Define the headers for the API request
        $headers = [
            'Content-Type' => 'application/json',
            'x-api-key' => '93c5ad2a-94d1-43b9-a8ef-177329cf528a',
            'x-trace-id' => 'POSB-REMIT' . uniqid(),
        ];

        // Define other required variables
        $schoolAccountNumber = "01-04-400-20806001";
        $currency = "USD";

        // Prepare the body of the request
        $body = [
            "TellerEthixUsername" => strval($user),
            "schoolAccountNumber" => strval($schoolAccountNumber),
            "posTransactionReference" => 'CASH-REMITANCE' . Str::random(9),
            // "description" => $request->senderFirstName . " " . $request->senderLastName . " Send " . $request->principal_amount . " To " . $request->recipientFirstName . " " . $request->recipientLastName . " Country: " . $request->receiver['fxrate']['country'],
            "description" => $senderFirstName . " " . $senderLastName . " " . " Send "  ." USD ". $principalAmount . " To " . $recipientFirstName . " " . $recipientLastName . " Country: " . $receiver->fxrate->country . ". Reference number: { $payment->transaction_reference}. Paid on: " . Carbon::today()->toDateString(),
            "amount" => $request->principal_amount,
            "currency" => strval($currency),
        ];

        // Log the request
        Log::info('Request to Principal Ethix API', [
            'url' => 'http://10.50.30.88:10001/api/v1/payment-transfer/instruction',
            'headers' => $headers,
            'body' => $body
        ]);

        // Create the transaction with initial status
        $transaction = EthixTransaction::create(array_merge($body, ['status' => 'pending']));

      

        // Define the API endpoint
        $apiEndpoint = 'http://10.50.30.88:10001/api/v1/payment-transfer/instruction';

        try {
            // Make the HTTP POST request
            $response = Http::withHeaders($headers)->post($apiEndpoint, $body);
            $responseData =json_decode($response->body(), true);

            // Log the response and update the transaction status based on the response
            if ($response->successful()) {
                Log::info('Successful Response from Principal Ethix API', [
                    'status' => $response->status(),
                    'body' => $response->body()
                    
                ]);
                
                // Update the transaction status to success
                $transaction->update(['status' => 'success' , 'posTransactionReference'=>$responseData['uniqueReference'] ]);
                $phoneNumber = $sender_phone_number;
                $senderName =$senderFirstName . " " . $senderLastName;
                $referenceNumber = $payment->transaction_reference;
                $amount = $request->input('principal_amount');
                

                $this->sendSMS($phoneNumber, $senderName, $currency, $amount, $referenceNumber);
            } else {
                Log::error('Failed Response from Principal Ethix API', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                // Leave the status as pending or set it to failed if desired
                $transaction->update(['status' => 'failed']);
            }
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Exception during Ethix API call', ['message' => $e->getMessage()]);
            // Update the transaction status to failed
            $transaction->update(['status' => 'failed']);
        }

                    // Check if the request was successful
                    if ($response->successful()) {
                        $responseData = $response->json();
                        // Do something with $responseData, like returning it or processing it further
                        
                        $apiEndpoint = 'http://10.50.30.88:10001/api/v1/payment-transfer/instruction';
                        $feesAccountNumber = "01-04-400-40608001";
                        $body1 = [
                            "TellerEthixUsername" => strval($user),
                            "schoolAccountNumber" => strval($feesAccountNumber),
                            "posTransactionReference" => 'CASH-REMIT' . Str::random(9),
                            "description" =>  $senderFirstName." ". $senderLastName . " " ." Send " . $principalAmount. " To " . $recipientFirstName."  ". $recipientLastName ." Country: ". $receiver->fxrate->country,
                            "amount" => $request->input('total_principal_amount'),
                            "currency" => strval($currency),
                        ];
                        Log::info(' Request to Fees  API', [
                            'url' => 'http://10.50.30.88:10001/api/v1/payment-transfer/instruction',
                            'headers' => $headers,
                            'body' => $body1
                        ]);
                         // Create the transaction with initial status
                         $transaction = EthixTransaction::create(array_merge($body1, ['status' => 'pending']));

                        // Make the HTTP POST request
                        $response = Http::withHeaders($headers)->post($apiEndpoint, $body1);
                        $responseData = $response->json();
    
                       
                        if ($response->status() < 200 || $response->status() >= 300) {
                            Log::error('Failed Response  from Fees Ethix API :', [
                                'status' => $response->status(),
                                'body' => $response->body()
                            ]);
                        } else {
                            Log::info('Successful Response  from Fees Ethix API:', [
                                'status' => $response->status(),
                                'body' => $response->body()
                            ]);
                            $transaction->update(['status' => 'success' , 'posTransactionReference'=>$responseData['uniqueReference'] ]);
                        }
    
                        // Check if the request was successful
                        if ($response->successful()) {
                            $responseData = $response->json();
                            // Do something with $responseData, like returning it or processing it further
                            // return redirect('/crossboader-payment')->with('message','Payment has been Submited Successfully');

                            $payment = Sendmoney::where('created_by', request()->user()->id)->orderBy('id', 'DESC')->first();

                            
            return redirect('crossboader-payment/' . $payment->id);

                        } else {
                            // Handle error
                            return response()->json([
                                'error' => 'Failed to connect to the Ethix API',
                                'message' => $response->body(),
                            ], $response->status());
                        }
                    } else {
                        // Handle error
                        return response()->json([
                            'error' => 'Failed to connect to the Ethix API',
                            'message' => $response->body(),
                        ], $response->status());
                    }

                   
                    
                 
                 return redirect('/crossboader-payment')->with('message','Payment has been Submited Successfully');
                //  return $responseData;  
         }
       
    }
    

    function generateTransactionReference() {
        // Define your format pattern
        $pattern = "POSB_REMIT_" . date("Y-M-D") . "_[random_string]";
        
        // Generate a random string
        $randomString = Str::random(12); // Use Str::random to generate a random string
        
        // Replace [random_string] with the generated random string
        $reference = str_replace("[random_string]", $randomString, $pattern);
        
        // Convert the entire reference to uppercase
        $reference = strtoupper($reference);
        
        return $reference;
    }

    private function sendSMS($phoneNumber, $senderName, $currency, $amount, $referenceNumber)
    {
        // Variables initialization
        $url = 'https://secure.zss.co.zw/vportal/cnm/vsms/plain';
        $user = 'posbcnm';
        $password = '$posb123';
    
        // Construct the message
        // Construct the message
        $message = "Int'l Remittance: {$amount}  {$currency}  received from {$senderName}." . 
                   " Ref: {$referenceNumber}. Date: " . 
                   Carbon::today()->toDateString() . ".";
    
        // Log the constructed message
        Log::info('Constructed SMS message', ['message' => $message]);
    
        // Make GET request using Laravel HTTP client
        try {
            $response = Http::get($url, [
                'user' => $user,
                'password' => $password,
                'sender' => "POSB Remit",
                'GSM' => $phoneNumber,
                'SMSText' => $message,
            ]);
    
            // Log the request details
            Log::info('SMS request sent', [
                'url' => $url,
                'params' => [
                    'user' => $user,
                    'password' => $password,
                    'sender' =>"POSB Remit",
                    'GSM' => $phoneNumber,
                    'SMSText' => $message,
                ],
                'response_status' => $response->status(),
                'response_body' => $response->body()
            ]);
    
            if ($response->successful()) {
                // Handle successful response
                Log::info('SMS sent successfully');
                return response()->json(['message' => 'SMS sent successfully'], 200);
            } else {
                // Handle failed response
                Log::error('Failed to send SMS', ['error' => $response->body()]);
                return response()->json(['message' => 'Failed to send SMS', 'error' => $response->body()], $response->status());
            }
        } catch (\Exception $e) {
            // Handle exception during HTTP request
            Log::error('An error occurred while sending SMS', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'An error occurred while sending SMS', 'error' => $e->getMessage()], 500);
        }
    }

}