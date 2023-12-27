<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
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
            $beneficiary = $customer->beneficiary()->paginate(5);

           
            
           return view('crossboarder.capture', compact('customer','id','beneficiary'));
        }
    }
    public function paymentRequest(Request $request )
    {
        
        // dd($request);
    
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

       
      
       
        $customer = Customer::find($request->input('sender_id'));
        $receiver = Beneficiary::find($request->input('recever_id'));
        $purpose_of_payment = $request->input('purpose_of_payment');
        $source_of_income = $request->input('source_of_income');
        
        
            if ($customer && $receiver ) {
            
                $senderFirstName = $customer->first_name;
                $senderLastName = $customer->surname;
                $senderDateofBirth = $customer->date_of_birth;
                $sender_house_number = $customer->house_number;
                $sender_address_area = $customer->area;
                $sender_sender_city = $customer->city; 
                $sender_phone_number= $customer->phone_number;  
                $sender_id= $customer->id_number;
                $transactionReference = $this->generateTransactionReference();
              

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
                    $paymentRequestData = [
                        "paymentrequest" => [
                            "transaction_reference" => $transactionReference,
                            "sender_account_uri" => "tel:+".$sender_phone_number,
                            "recipient_account_uri" =>"ewallet".$receiver->rec_ewallet,
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
                                "recipient_account_uri" => "ban:".$receiver->rec_ban,
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
        
                $user = request()->user();
        
               
                // $payment = new Sendmoney();
                // $payment->transaction_reference = $responseData['payment']['transaction_reference'];
                // $payment->status = $responseData['payment']['status'];
                // $payment->fees_amount = $responseData['payment']['fees_amount']['amount'];
                // $payment->charged_amount = $responseData['payment']['charged_amount']['amount'];
                // $payment->credited_amount = $responseData['payment']['credited_amount']['amount'];
                // $payment->principal_amount = $responseData['payment']['principal_amount']['amount'];
                // $payment->currency = $responseData['payment']['principal_amount']['currency'];
                // $payment->sender_account_uri = $responseData['payment']['sender_account_uri'];
                // $payment->recipient_account_uri = $responseData['payment']['recipient_account_uri'];
                // $payment->payment_amount = $responseData['payment']['payment_amount']['amount'];
                // $payment->payment_origination_country = $responseData['payment']['payment_origination_country'];
                // $payment->fx_rate = $responseData['payment']['fx_rate'];
                
                // // Check if bank_code exists in $responseData before setting it
                // if (isset($responseData['payment']['bank_code'])) {
                //     $payment->bank_code = $responseData['payment']['bank_code'];
                // } else {
                //     // Handle the case where bank_code is not available
                //     $payment->bank_code = null; // or set it to a default value, if necessary
                // }
                
                // $payment->payment_type = $responseData['payment']['payment_type'];
                // $payment->source_of_income = $responseData['payment']['source_of_income'];
                // $payment->settlement_details = $responseData['payment']['settlement_details']['amount'];
                // $payment->cashout_code = $responseData['payment']['cashout_code'];
                // $payment->created_by = $user->id;
                // $payment->modified_by = $user->id;
                // $payment->created_at = now();
                // $payment->save();
                 
                // return redirect('/crossboader-payment')->with('message','Payment has been Submited Successfully');
                 return $responseData;  
            }
       
    }




    function generateTransactionReference() {
        // Define your format pattern
        $pattern = "POSB_" . date("Y-M-D") . "_[random_string]";
        
        // Generate a random string
        $randomString = Str::random(12); // Use Str::random to generate a random string
        
        // Replace [random_string] with the generated random string
        $reference = str_replace("[random_string]", $randomString, $pattern);
        
        return $reference;
    }
    public function proceedRequest(Request $request  )
    {
        
       
        $customer = $request->input('user_id');
        $beneficiary = $request->input('customer_id');
        $amount = $request->input('amount');
        $source_of_income = $request->input('source_of_income');
        $purpose_of_payment = $request->input('purpose_of_payment');
        

        $sender = Customer::find($customer);
        $receiver = Beneficiary::find($beneficiary);

        return view('crossboarder.confirm_payment', compact('sender','receiver','amount','source_of_income','purpose_of_payment'));

    }



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

       
        $payload =  json_encode('hello', JSON_PRETTY_PRINT);

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
