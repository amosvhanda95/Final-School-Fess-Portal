<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Payment;
use App\Enum\PaymentStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\SchoolBankAccount;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class GoldenController extends Controller
{
    //


    public  function goldenshow()
    {
        return view('member.goldencreate');
    }


    public function goldenidSearch(Request $request)
    {
        $request->validate([
            'account_number' => 'required|numeric',
            'phone_number' => 'required',
            'sbu' => 'required'
        ]);
    
        $accountNumber = $request->input('account_number');
    $mobileNumber = $request->input('phone_number');
    $sbu = $request->input('sbu');
    
    // Fetch the bank account details from the database
    $bankAccount = SchoolBankAccount::where('account_number', $accountNumber)->first();
    
    // Prepare to fetch data from the API
    $client = new Client();
    $url = 'http://45.134.226.215:9008/flames-integration/members/findbymobile/' . urlencode($mobileNumber) . '/' . urlencode($sbu);
    
    // Initialize variables for API response data
    $apiData = [];
    $apiError = null;
    
    try {
        // Send GET request to the API
        $response = $client->request('GET', $url);
       
    
        if ($response->getStatusCode() == 200) {
            $apiData = json_decode($response->getBody(), true);
            
            
    
            // Extract the 'fullname' and other details from the API data
            $fullname = $apiData['fullname'] ?? null;
            $policy = $apiData['policy'] ?? [];
            $policyNumber = $apiData['policyNumber'] ?? null;
            $message = $apiData['message'] ?? null;
    
            return view('member.details', [
                'bankAccount' => $bankAccount,
                'apiData' => $apiData,
                'fullname' => $fullname,
                'policy' => $policy,
                'policyNumber' => $policyNumber,
                'message' => $message,
                'apiError' => $apiError
            ]);
        } else {
            $apiError = 'Error fetching details from the API';
        }
    } catch (\Exception $e) {
        $apiError = 'Exception occurred: ' . $e->getMessage();
    }
    }



    public function goldenmakePayment(Request $request)

    


    {
       
        $rrn = $request->input('rrn') ?? ('CASH' . Str::random(9));
        $paymentMethod = strtolower($request->input('payment_method'));
        $request->validate([
            'payment_method' => 'required|string|in:cash,swipe', // Adjust the validation rule as needed
            'amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'amount_in_words' => 'required',
            // Add other validation rules for other fields if necessary
        ]);
    
        $isAgent = auth()->user()->type == 5;

        if ($isAgent) {
            $paymentMethod = strtolower($request->input('payment_method'));
            $selectedAccountNumber = $request->input('currency');
            $explodedAccountNumbers = explode(',', request()->user()->account_number);
        
            // Choose the appropriate part of the exploded account number based on $selectedAccountNumber
            if ($selectedAccountNumber === 'ZiG') {
                // Take the first exploded number
                $selectedAccountNumber = $explodedAccountNumbers[0];
            } else {
                // Take the second exploded number
                $selectedAccountNumber = $explodedAccountNumbers[1];
            }
        
            // Continue with further processing...
        }
  
        
    
        $user = $isAgent ? $selectedAccountNumber : request()->user()->ethics_user;
   
        
   
      
        $headers = [
            'Content-Type' => 'application/json',
            'x-api-key' => '93c5ad2a-94d1-43b9-a8ef-177329cf528a',
            'x-trace-id' => 'POSB-' . uniqid(),
        ];
      
       
    
        $schoolAccountNumber = SchoolBankAccount::find($request->input('bank_account_id'))->account_number;
        $currency = SchoolBankAccount::find($request->input('bank_account_id'))->currency;
    
        $body = [
            $isAgent ? "agentAccountNumber" : "TellerEthixUsername" => strval($user),
            "schoolAccountNumber" => strval($schoolAccountNumber),
            "posTransactionReference" => $rrn,
            "description" => $request->input('student_name') . "|" . $request->input('class') . "|" . $request->input('purpose'),
            "amount" => $request->input('amount'),
            "currency" => strval($currency),
        ];

        

    
        $apiEndpoint = $isAgent ? 'http://10.50.30.88:10001/api/v1/payment-transfer/instruction-between-accounts' : 'http://10.50.30.88:10001/api/v1/payment-transfer/instruction';
        
    
        $response = Http::withHeaders($headers)->post($apiEndpoint, $body);
   
        $responseData = json_decode($response->body(), true);
    
        if ($responseData && isset($responseData['responseCode'])) {
            $paymentStatus = $responseData['responseCode'] === 0 ? 'Success' : 'Fail';
            $paymentSta = $responseData['uniqueReference'];
    
            Payment::create([
                'paid_at' => Carbon::today()->toDateString(),
                'school_id' => $request->input('school_id'),
                'bank_account_id' => $request->input('bank_account_id'),
                'branch_id' => request()->user()->branch->id,
                'amount' => $request->input('amount'),
                'student_name' => $request->input('student_name'),
                'amount_in_words' => $request->input('amount_in_words'),
                'currency_value' => $currency,
                'reference_number' => $paymentSta,
                'rrn' => $rrn,
                'payment_status' => $paymentStatus,
                'payment_method' => $paymentMethod,
                'reg_number' => $request->input('reg_number'),
                'semester' => $request->input('semester'),
                'term' => $request->input('term'),
                'depositor_name' => $request->input('depositor_name'),
                'class' => $request->input('class'),
                'year' => date('Y'),
                'purpose' => $request->input('purpose'),
                'status' => PaymentStatus::Captured,
                'created_by' => request()->user()->id,
                'modified_by' => request()->user()->id,
            ]);
            $currentDate = date('Y-m-d ');
            $url = 'https://secure.zss.co.zw/vportal/cnm/vsms/plain';
            $user = 'posbcnm';
            $password = '$posb123';
            $sender = 'POSB Fees';
            $phoneNumber = $request->input('customer_phone_number');
            $regNumber = $request->input('reg_number');
$message = "Payment of {$request->input('amount')} {$currency} received from {$request->input('student_name')}" . ($regNumber ? " (Policy. No: {$regNumber})" : '') . ". Reference number: {$paymentSta}. Paid on: " . Carbon::today()->toDateString();

    
            // Make GET request using Laravel HTTP client
            $response = Http::get($url, [
                'user' => $user,
                'password' => $password,
                'sender' => $sender,
                'GSM' => $phoneNumber,
                'SMSText' => $message,
            ]);
            try {

                Log::info('HTTP  Request:', [
                    'url' => 'http://45.134.226.215:9008/flames-integration/receipts/payments',
                    'method' => 'POST',
                    'headers' => [
                        'AccessKey' => '',
                        'Content-Type' => 'application/json',
                    ],
                    'payload' => [
                        "amount" => $request->input('amount'),
                        "policyNumber" => $request->input('reg_number'),
                        "dateOfPayment" => strval($currentDate),
                        "reference" => strval($paymentSta),
                        "currency" => strval(SchoolBankAccount::findOrFail($request->input('bank_account_id'))->currency),
                    ],
                ]);
            
                if ($response->successful()) {
                    // Handle successful response
                    Log::info('HTTP Response Golden:', [
                        'status' => $response->status(),
                        'body' => $response->body(),
                    ]);
                } else {
                    // Handle unsuccessful response
                    Log::error('HTTP Response Golden:', [
                        'status' => $response->status(),
                        'body' => $response->body(),
                    ]);
                    // You may want to throw an exception here depending on your application's logic
                }
            } catch (RequestException $e) {
                // Handle exception
                Log::error('HTTP Request exception Golden:', [
                    'message' => $e->getMessage(),
                ]);
            }

           
     $payment = Payment::where('created_by', request()->user()->id)->orderBy('id', 'DESC')->first();
            return redirect('golden_payment/confirm/' . $payment->id);
            
        } else {
            // Handle API response errors
            return $responseData;
        }
       
        
      
    }

    public function confirmPayment($id)
    {
        $paymentReference = 'POSB-' . uniqid();
        $payment = Payment::findOrFail($id);
        return view('member.confirm_payment', compact('payment', 'paymentReference'));
    }
    public function confirmedPayment($id)
    {
        $paymentReference = 'POSB-' . uniqid();
        $payment = Payment::findOrFail($id);
        return view('member.confirmed_payment', compact('payment', 'paymentReference'));
    }
    public function submitPayment(Request $request)
    {


        $payment = Payment::findOrFail($request->input('payment_id'));


        if ($payment->status != PaymentStatus::Captured) {

            return redirect('/payments')->with('message', 'Payment was sent and Processed');
        } else {
            return redirect()->back()->withErrors(['This payment cannot be processed at the moment, contact Support']);
        }
    }

}
