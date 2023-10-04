<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Customer;
use App\Models\Sendmoney;
use Illuminate\Support\Str;


use Illuminate\Http\Request;
use Mastercard\Developer\OAuth\OAuth;
use Umpirsky\CountryList\CountryList;
use Mastercard\Developer\OAuth\Utils\AuthenticationUtils;

class APIController extends Controller
{
    public function index()
    {
       
        return view('crossboarder.search');
    }

    public  function show()
    {
        return view('crossboarder.search');
    }

    public function searchByIdNumber(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id_number' => 'required|string', // You can adjust the validation rules as needed
        ]);

        // Search for the customer by id_number
        $idNumber = $request->input('id_number');
        $customer = Customer::where('id_number', $idNumber)->first();

        if (!$customer) {
            // Customer not found
          return redirect()->back()->withErrors([' Customer ID Is Not Registered']);
        }
        
        // Customer found, return the details
        return redirect('crossboarder/capture_details/' . $customer->id)->with('message', 'Customer found, now you can proceed');
    }

    public function captureDetails($customer)
    {
        $id = $customer;
       
        if (is_null($customer))
        {
            redirect('crossboarder')->withErrors(['You had skipped this stage']);
        }
        
        else
        {
            $customer = Customer::findOrFail($customer);
            
           return view('crossboarder.capture', compact('customer','id'));
        }
    }
    public function paymentRequest(Request $request )
    {
        
    
        // Load your signing key
        $signingKey = AuthenticationUtils::loadSigningKey(
            'API-TEST2-sandbox.p12',
            'keyalias',
            'keystorepassword'
        );
        
      

        // Define your Mastercard credentials and endpoint
        $consumerKey = 'eEHw5mRX6ZsPQtjBaIx9_JeobetpR3MwrqxKBzTs29db017c!9b0af67b746443748ceb659ff77bc9ba0000000000000000';
        $uri = 'https://sandbox.api.mastercard.com/send/v1/partners/BEL_MASEND5ged2/crossborder/payment';
        $method = 'POST';

        // Create an associative array with the JSON data

        $validatedData = $request->validate([
           

            'rec_first_name' => 'required|string',
            'rec_surname' => 'required|string',
            
            'rec_house_number'=> 'required|string',
            'rec_area'=> 'required|string',
           
            'country' => 'required',
 
        ]);
        $customerId =$request->input('user_id');
        $ReceiverPhone =$request->input('rec_phone_number');
        $customer = Customer::find($customerId);

        
            if ($customer) {
            
                $senderFirstName = $customer->first_name;
                $senderLastName = $customer->surname;
                $senderDateofBirth = $customer->date_of_birth;
                $sender_house_number = $customer->house_number;
                $sender_address_area = $customer->area;
                $sender_sender_city = $customer->city;
                $transactionReference  = $request->input('transaction_reference');
                $id  = $request->input('id');
        

                
                $jsonData = json_decode($request->input('json_data'), true);

                
                foreach ($jsonData['quote']['proposals']['proposal'] as $proposal) {
                 $masterCharge = $proposal['charged_amount']['amount'] . $proposal['principal_amount']['currency'] ;
                 $totalCharged = $proposal['charged_amount']['amount'] + $proposal['principal_amount']['amount'] * 0.05 + $proposal['principal_amount']['amount'] * 0.01;
                 $creditedAmount = $proposal['credited_amount']['amount']  . $proposal['principal_amount']['currency']  ;
                 $Amount = $proposal['principal_amount']['amount']* 0.06    ;
                 $principalAmount = $proposal['principal_amount']['amount'] . $proposal['principal_amount']['currency'] ;
                 $bankCharge = $proposal['principal_amount']['amount'] * 0.05 . $proposal['principal_amount']['currency'] ;
                 $RBZCharge = $proposal['principal_amount']['amount'] * 0.01 . $proposal['principal_amount']['currency'];
                }


               



        $recipientFirstName = $request->input('rec_first_name');
        $recipientLastName = $request->input('rec_surname');
        $receiver_house_number = $request->input('rec_house_number');
        $receiver_address_area = $request->input('rec_area');
        $receiver_sender_city = $request->input('rec_city');
        $receiveCountry =$request->input('country');
       
        

        $paymentRequestData = [
            "paymentrequest" => [
                "transaction_reference" => $transactionReference,
                "proposal_id" => $id,
                
               
                "receiving_bank_name" => "POSB ZIMBABWE",
                "receiving_bank_branch_name" => "",
                "bank_code" => "NP021",
                
                "source_of_income" => "Sal",
                "sender" => [
                    "first_name" => $senderFirstName,
                    "last_name" => $senderLastName,
                    "nationality" => "ZWE",
                    "address" => [
                        "line1" => $sender_house_number,
                        "line2" => $sender_address_area,
                        "city" =>  $sender_sender_city,
                        "postal_code" => "00263 ",
                        "country" => "ZWE"
                    ],
                    "date_of_birth" => $senderDateofBirth 
                ],

                "recipient" => [
                    "first_name" => $recipientFirstName,
                    "last_name" => $recipientLastName,
                    "organization_name" => "",
                    "address" => [
                        "line1" => $receiver_house_number,
                        "line2" =>$receiver_address_area  ,
                        "city" => $receiver_sender_city,
                        
                        
                        "country" => $receiveCountry
                    ],
                    "email" => "customer@gmail.com"
                ],
                "payment_file_identifier" => "1abdtr236"
            ]
        ];

            } 
            else 
            {
                return redirect()->back()->withErrors([' Customer ID Is Not Found']);
            }
        
        
        

       
        
            

 
        // Now, $phpArray contains the JSON data as an associative PHP array
        


        // Convert the PHP array to a JSON string
        $payload =  json_encode($paymentRequestData, JSON_PRETTY_PRINT);

        // Now, you can use $payload in your API request


        // Prepare the payload and headers
        $headers = [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload),
            'Authorization: ' . OAuth::getAuthorizationHeader($uri, $method, $payload, $consumerKey, $signingKey)
        ];

        // Initialize a cURL handle
        $handle = curl_init($uri);

        // Set cURL options
        curl_setopt_array($handle, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => $headers
        ]);

        // Execute the cURL request
        $result = curl_exec($handle);

        // Check for errors and handle the response
        if (curl_errno($handle)) {
            return response()->json(['error' => 'cURL error: ' . curl_error($handle)], 500);
        }

        // Close the cURL handle
        curl_close($handle);
        $responseData= json_decode($result ,true);

        $jsonData = $responseData;

        $status = $responseData['payment']['status'];
        $transaction_reference = $responseData['payment']['transaction_reference'];
       
        $id = $responseData['payment']['id'];
        Sendmoney::create([
            
            'transaction_reference'=>$transaction_reference,
            'status'=>$status,
            'id_from_API'=>$id,
            'customer_id' =>$customerId,
            'amount' =>$Amount,
            'rec_first_name' =>$recipientFirstName,
            'rec_surname' =>$recipientLastName,
            'rec_house_number' =>$receiver_house_number,
            'rec_area'=> $receiver_address_area,
            'rec_city'=>$receiver_sender_city,
            'country'=> $receiveCountry,
            
            
            'fees_amount'=> $totalCharged,
            'charged_amount'=> $masterCharge,
            'credited_amount'=> $creditedAmount ,
            'principal_amount'=> $principalAmount ,
            'recipient_account_uri'=>$ReceiverPhone,
        ]);
       
        // return  view('crossboarder.success')->with('message', 'Payment Successful!');
        return  $jsonData;
       
    }

    public function qoutationRequest(Request $request  )
    {
        
        // Load your signing key
        $signingKey = AuthenticationUtils::loadSigningKey(
            'API-TEST2-sandbox.p12',
            'keyalias',
            'keystorepassword'
        );
        
      

        // Define your Mastercard credentials and endpoint
        $consumerKey = 'eEHw5mRX6ZsPQtjBaIx9_JeobetpR3MwrqxKBzTs29db017c!9b0af67b746443748ceb659ff77bc9ba0000000000000000';
       
        $uri = 'https://sandbox.api.mastercard.com/send/v1/partners/BEL_MASEND5ged2/crossborder/quotes';
        $method = 'POST';

        // Create an associative array with the JSON data

        $validatedData = $request->validate([
           
            'phone_number'=> 'required',
            'rec_phone_number' => 'required',
            'rec_amount'=>'required',
            'currency' => 'required',
        ]);

        
        $sender_Phone = $request->input('phone_number'); 
        $transactionReference  = Str::uuid();
        $amount = $request->input('rec_amount');
        
        $receiverPhone= $request->input('rec_phone_number');
        $sendcurrency =$request->input('currency');
        $sendfees =$request->input('fees');

        $paymentRequestData = [
            "quoterequest" => [
                "transaction_reference" =>  "09".$transactionReference,
                "sender_account_uri" =>  "tel:+".$sender_Phone,
                "recipient_account_uri" => "tel:+".$receiverPhone,
                "payment_amount" => [
                    "amount" => $amount,
                    "currency" => $sendcurrency 
                ],
                "payment_origination_country" => "ZWE",
                "payment_type" => "P2P",
                "quote_type" => [
                    "forward" => [
                        "receiver_currency" => "USD" ,
                        "fees_included" => false,
                    ],
                ],
            ]
        ];
        
            
         
         
 






 

 
        // Now, $phpArray contains the JSON data as an associative PHP array
        


        // Convert the PHP array to a JSON string
        $payload =  json_encode($paymentRequestData, JSON_PRETTY_PRINT);

        // Now, you can use $payload in your API request




        // Prepare the payload and headers
        $headers = [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload),
            'Authorization: ' . OAuth::getAuthorizationHeader($uri, $method, $payload, $consumerKey, $signingKey)
        ];

        // Initialize a cURL handle
        $handle = curl_init($uri);

        // Set cURL options
        curl_setopt_array($handle, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => $headers
        ]);

        // Execute the cURL request
        $result = curl_exec($handle);

        // Check for errors and handle the response
        if (curl_errno($handle)) {
            return response()->json(['error' => 'cURL error: ' . curl_error($handle)], 500);
        }

        // Close the cURL handle
        curl_close($handle);
        $data= json_decode($result ,true);

         
        $transactionReference = $data['quote']['transaction_reference'];
        $paymentType = $data['quote']['payment_type'];
        
        // Accessing values within the "proposal" array:
        $proposals = $data['quote']['proposals']['proposal'];
        foreach ($proposals as $proposal) {
            $id = $proposal['id'];
            $resourceType = $proposal['resource_type'];
            $feesIncluded = $proposal['fees_included'];
        
            // Accessing values within sub-objects like "charged_amount":
            $chargedAmount = $proposal['charged_amount']['amount'];
            $chargedCurrency = $proposal['charged_amount']['currency'];
        
            // Accessing values within sub-objects like "credited_amount":
            $creditedAmount = $proposal['credited_amount']['amount'];
            $creditedCurrency = $proposal['credited_amount']['currency'];
        
            // Accessing values within sub-objects like "principal_amount":
            $principalAmount = $proposal['principal_amount']['amount'];
            $principalCurrency = $proposal['principal_amount']['currency'];
        }
        
        
         
         //$id = $responseData['quote']['proposals']['proposal']['id'];
        // Sendmoney::create([
        //     'status'=>$status,
        //     'transaction_reference'=>$transaction_reference,
        //     'id_from_API'=>$id,
            
        // ]); 
        $jsonData = $data;
        $id = $request->input('user_id');
        $receiverPhone= $request->input('rec_phone_number');

        return  view('crossboarder.confirmed', compact('jsonData' ,'id','receiverPhone' ));
    //   return  $jsonData ;
    }




    // 

    public function ratesRequest(Request $request  )
    {
        
        // Load your signing key
        $signingKey = AuthenticationUtils::loadSigningKey(
            'API-TEST2-sandbox.p12',
            'keyalias',
            'keystorepassword'
        );
        
      

        // Define your Mastercard credentials and endpoint
        $consumerKey = 'eEHw5mRX6ZsPQtjBaIx9_JeobetpR3MwrqxKBzTs29db017c!9b0af67b746443748ceb659ff77bc9ba0000000000000000';
       
        $uri = 'https://sandbox.api.mastercard.com/send/v1/partners/BEL_MASEND5ged2/crossborder/rates';
        $method = 'GET';

       
        $payload =  json_encode('', JSON_PRETTY_PRINT);

        $headers = [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload),
            'Authorization: ' . OAuth::getAuthorizationHeader($uri, $method, $payload, $consumerKey, $signingKey)
        ];

        // Initialize a cURL handle
        $handle = curl_init($uri);

        // Set cURL options
        curl_setopt_array($handle, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => $headers
        ]);

        // Execute the cURL request
        $result = curl_exec($handle);

        // Check for errors and handle the response
        if (curl_errno($handle)) {
            return response()->json(['error' => 'cURL error: ' . curl_error($handle)], 500);
        }

        // Close the cURL handle
        curl_close($handle);
        $data= json_decode($result ,true);
       

      return  $data ;
    }
}
