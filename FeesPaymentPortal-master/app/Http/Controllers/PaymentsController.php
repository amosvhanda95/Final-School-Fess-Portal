<?php

namespace App\Http\Controllers;

use Error;
use Exception;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use App\Models\School;
use App\Models\Payment;
use App\Models\Student;
use App\Enum\PaymentStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SchoolBankAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends Controller
{
    public function index()

    {
        $user = request()->user();

        if ($user->id === 1) {
            // If the user ID is 1, display all payments.
            $data = Payment::orderBy('created_at', 'desc')
                ->paginate(5);
        } else {
            // Otherwise, display payments of the authenticated user.
            $data = Payment::where('created_by', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }
        return view('payments.index', compact('data'));
    }
    public  function show()
    {
        return view('payments.create');
    }
    public  function zolshow()
    {
        return view('payments.zoucreate');
    }
    public function accountSearch(Request $request)
    {
        $this->validateWith([
            'account_number' => 'required:numeric'
        ]);

        $accountNumber = $request->input('account_number');
        $bankAccount = SchoolBankAccount::where('account_number', $accountNumber)
            ->where('status', '1')->first();
        if (!is_null($bankAccount)) {
            return redirect('payment/capture_details/' . $bankAccount->id)->with('message', 'Bank Account found, now you can proceed');
        } else {
            return redirect()->back()->withErrors(['Bank Account number is Invalid, please check on the deposit slip and try again, If the problem persists contact support']);
        }
    }

    public function idaccountSearch(Request $request)
    {
        $this->validateWith([
            'account_number' => 'required:numeric',
            'reg_number' => 'required'

        ]);
        // dd($request);

        $accountNumber = $request->input('account_number');
        $RegNumber = $request->input('reg_number');
        $bankAccount = SchoolBankAccount::where('account_number', $accountNumber)->first();
        //change here to find the student in the data base 
        $RegAccount = Student::where('studentcode', $RegNumber)->first();
        if (!is_null($bankAccount) & !is_null($RegAccount)) {
            return redirect('payment/capture_details/' . $bankAccount->id . '/' . $RegAccount->id)->with('message', 'Bank Account found, now you can proceed');
        } else {
            return redirect()->back()->withErrors(['Bank Account or Reg Number number is Invalid, please check on the deposit slip and try again, If the problem persists contact support']);
        }
    }
    public function captureDetails($bankDetailsId)
    {
        if (is_null($bankDetailsId)) {
            redirect('payment/create')->withErrors(['You had skipped this stage']);
        } else {
            $bankAccount = SchoolBankAccount::findOrFail($bankDetailsId);
            return view('payments.capture_details', compact('bankAccount'));
        }
    }
    public function zoucaptureDetails($bankDetailsId, $Stdid)
    {
        if (is_null($bankDetailsId)) {
            redirect('payment/create')->withErrors(['You had skipped this stage']);
        } else {
            $bankAccount = SchoolBankAccount::findOrFail($bankDetailsId);
            //Change to match the students table
            $Student = Student::findOrFail($Stdid);

            return view('payments.zoucapture_details', compact('bankAccount', 'Student'));
        }
    }
    public function ediDetails($bankDetailsId)
    {
        if (is_null($bankDetailsId)) {
            redirect('payment/create')->withErrors(['You had skipped this stage']);
        } else {
            $bankAccount = Payment::findOrFail($bankDetailsId);
            return view('payments.edit', compact('bankAccount'));
        }
    }

    public function makePayment(Request $request)


    {

        if (auth()->user()->type == 5) {



            $headers = [
                'Content-Type' => 'application/json',
                'x-api-key' => '93c5ad2a-94d1-43b9-a8ef-177329cf528a',
                'x-trace-id' => 'POSB-' . uniqid(),
            ];
            $schoolAccountNumber = SchoolBankAccount::find($request->input('bank_account_id'))->account_number;
            $currency = SchoolBankAccount::find($request->input('bank_account_id'))->currency;
            $user = request()->user()->account_number;



            $body = [

                "agentAccountNumber" => strval($user),
                "schoolAccountNumber" => strval($schoolAccountNumber),
                "posTransactionReference" => $request->input('rrn'),
                "description" =>  $request->input('student_name')."|".$request->input('class')."|".$request->input('purpose'),
                "amount" => $request->input('amount'),
                "currency" => strval($currency),

            ];






            $response = Http::withHeaders($headers)
                ->post('http://10.50.30.88:10001/api/v1/payment-transfer/instruction-between-accounts', $body);

            $responseData = json_decode($response->body(), true);



            if ($responseData && isset($responseData['responseCode'])) {

                $paymentStatus = $responseData['responseCode'] === 0 ? 'Success' : 'Fail';
                $paymentSta = $responseData['uniqueReference'];

                Payment::create([
                    'paid_at' => Carbon::today()->toDateString(),
                    'school_id' => $request->input('school_id'),
                    'bank_account_id' => $request->input('bank_account_id'),
                    'branch_id' => $request->user()->branch->id,
                    'amount' => $request->input('amount'),
                    'student_name' => $request->input('student_name'),
                    'amount_in_words' => $request->input('amount_in_words'),
                    'currency_value' => SchoolBankAccount::findOrFail($request->input('bank_account_id'))->currency,
                    'reference_number' => $paymentSta,
                    'rrn' => $request->input('rrn'),
                    'payment_status' => $paymentStatus,
                    'customer_phone_number' => $request->input('customer_phone_number'),
                    'reg_number' => $request->input('reg_number'),
                    'semester' => $request->input('semester'),
                    'term' => $request->input('term'),
                    'depositor_name' => $request->input('depositor_name'),
                    'class' => $request->input('class'),
                    'year' => $request->input('year'),
                    'purpose' => $request->input('purpose'),
                    'status' => PaymentStatus::Captured,
                    'created_by' => request()->user()->id,
                    'modified_by' => request()->user()->id,

                ]);



                $payment = Payment::where('created_by', request()->user()->id)->orderBy('id', 'DESC')->first();
                return redirect('payment/confirm/' . $payment->id);
            } else {

                return $responseData;
            }
        } else {

            $this->validateWith([

                'amount' => 'numeric:required |regex:/^\d+(\.\d{1,2})?$/',
                'amount_in_words' => 'required',
                'year' => 'required',
                'customer_phone_number' => 'required',

            ]);

            $validator = Validator::make($request->all(), [
                'rrn' => 'required|unique:payments',
                // Add other validation rules as needed
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }


            $headers = [
                'Content-Type' => 'application/json',
                'x-api-key' => '93c5ad2a-94d1-43b9-a8ef-177329cf528a',
                'x-trace-id' => 'POSB-' . uniqid(),
            ];
            $schoolAccountNumber = SchoolBankAccount::find($request->input('bank_account_id'))->account_number;
            $currency = SchoolBankAccount::find($request->input('bank_account_id'))->currency;
            $user = request()->user()->ethics_user;

            $body = [

                "TellerEthixUsername" => strval($user),
                "schoolAccountNumber" => strval($schoolAccountNumber),
                "posTransactionReference" => $request->input('rrn'),
                "description" =>  $request->input('student_name')."|".$request->input('class')."|".$request->input('purpose'),
                "amount" => $request->input('amount'),
                "currency" => strval($currency),


            ];






            $response = Http::withHeaders($headers)
                ->post('http://10.50.30.88:10001/api/v1/payment-transfer/instruction', $body);

            $responseData = json_decode($response->body(), true);



            if ($responseData && isset($responseData['responseCode'])) {

                $paymentStatus = $responseData['responseCode'] === 0 ? 'Success' : 'Fail';
                $paymentSta = $responseData['uniqueReference'];

                Payment::create([
                    'paid_at' => Carbon::today()->toDateString(),
                    'school_id' => $request->input('school_id'),
                    'bank_account_id' => $request->input('bank_account_id'),
                    'branch_id' => $request->user()->branch->id,
                    'amount' => $request->input('amount'),
                    'student_name' => $request->input('student_name'),
                    'amount_in_words' => $request->input('amount_in_words'),
                    'currency_value' => SchoolBankAccount::findOrFail($request->input('bank_account_id'))->currency,
                    'reference_number' => $paymentSta,
                    'rrn' => $request->input('rrn'),
                    'payment_status' => $paymentStatus,
                    'customer_phone_number' => $request->input('customer_phone_number'),
                    'reg_number' => $request->input('reg_number'),
                    'semester' => $request->input('semester'),
                    'term' => $request->input('term'),
                    'depositor_name' => $request->input('depositor_name'),
                    'class' => $request->input('class'),
                    'year' => $request->input('year'),
                    'purpose' => $request->input('purpose'),
                    'status' => PaymentStatus::Captured,
                    'created_by' => request()->user()->id,
                    'modified_by' => request()->user()->id,

                ]);



                $payment = Payment::where('created_by', request()->user()->id)->orderBy('id', 'DESC')->first();
                return redirect('payment/confirm/' . $payment->id);
            } else {
                // Handle the case where the response does not contain a responseCode
                return $responseData;
            }
        }
    }

    public function zoumakePayment(Request $request)


    {
        if (auth()->user()->type == 5) {

           

            $this->validateWith([

                'amount' => 'numeric:required |regex:/^\d+(\.\d{1,2})?$/',
                'amount_in_words' => 'required',
                'year' => 'required',
                'customer_phone_number' => 'required',

            ]);
            $validator = Validator::make($request->all(), [
                'rrn' => 'required|unique:payments',
                // Add other validation rules as needed
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }


            $headers = [
                'Content-Type' => 'application/json',
                'x-api-key' => '93c5ad2a-94d1-43b9-a8ef-177329cf528a',
                'x-trace-id' => 'POSB-' . uniqid(),
            ];
            $schoolAccountNumber = SchoolBankAccount::find($request->input('bank_account_id'))->account_number;
            $currency = SchoolBankAccount::find($request->input('bank_account_id'))->currency;
            $user = request()->user()->account_number;

            $body = [

                "agentAccountNumber" => strval($user),
                "schoolAccountNumber" => strval($schoolAccountNumber),
                "posTransactionReference" => $request->input('rrn'),
                "description" =>  $request->input('student_name')."|".$request->input('class')."|".$request->input('purpose'),
                "amount" => $request->input('amount'),
                "currency" => strval($currency),


            ];



            $response = Http::withHeaders($headers)
                ->post('http://10.50.30.88:10001/api/v1/payment-transfer/instruction-between-accounts', $body);

            $responseData = json_decode($response->body(), true);



            if ($responseData && isset($responseData['responseCode'])) {

                $paymentStatus = $responseData['responseCode'] === 0 ? 'Success' : 'Fail';
                $paymentSta = $responseData['uniqueReference'];

                Payment::create([
                    'paid_at' => Carbon::today()->toDateString(),
                    'school_id' => $request->input('school_id'),
                    'bank_account_id' => $request->input('bank_account_id'),
                    'branch_id' => $request->user()->branch->id,
                    'amount' => $request->input('amount'),
                    'student_name' => $request->input('student_name'),
                    'amount_in_words' => $request->input('amount_in_words'),
                    'currency_value' => SchoolBankAccount::findOrFail($request->input('bank_account_id'))->currency,
                    'reference_number' => $paymentSta,
                    'rrn' => $request->input('rrn'),
                    'payment_status' => $paymentStatus,
                    'customer_phone_number' => $request->input('customer_phone_number'),
                    'reg_number' => $request->input('reg_number'),
                    'semester' => $request->input('semester'),
                    'term' => $request->input('term'),
                    'depositor_name' => $request->input('depositor_name'),
                    'class' => $request->input('class'),
                    'year' => $request->input('year'),
                    'purpose' => $request->input('purpose'),
                    'status' => PaymentStatus::Captured,
                    'created_by' => request()->user()->id,
                    'modified_by' => request()->user()->id,

                ]);

                $currentDate = date('Y-m-d H:i:s');


                Http::withHeaders([
                    'AccessKey' => 'TESTING',
                    'Content-Type' => 'application/json',
                ])->post('http://api.zou.ac.zw/bank-service/post-transaction', [
                    "amount" => $request->input('amount'),
                    "bank_account_number" => strval($schoolAccountNumber),
                    "student_code" => $request->input('reg_number'),
                    "transaction_number" => $request->input('rrn'),
                    "branchdeposited" => "POSB",
                    "txntypecode" => "POS",
                    "txndate" => strval($currentDate),
                    "bankreference" => strval($paymentSta),
                    "currency" => strval(SchoolBankAccount::findOrFail($request->input('bank_account_id'))->currency),
                    "mti" => "",
                ]);



                $payment = Payment::where('created_by', request()->user()->id)->orderBy('id', 'DESC')->first();
                return redirect('payment/confirm/' . $payment->id);
                // return $responseData = $response1->body();
            } else {
                // Handle the case where the response does not contain a responseCode

                return $responseData;
            }
        } else {

            $this->validateWith([

                'amount' => 'numeric:required |regex:/^\d+(\.\d{1,2})?$/',
                'amount_in_words' => 'required',
                'year' => 'required',
                'customer_phone_number' => 'required',

            ]);
            $validator = Validator::make($request->all(), [
                'rrn' => 'required|unique:payments',
                // Add other validation rules as needed
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }


            $headers = [
                'Content-Type' => 'application/json',
                'x-api-key' => '93c5ad2a-94d1-43b9-a8ef-177329cf528a',
                'x-trace-id' => 'POSB-' . uniqid(),
            ];
            $schoolAccountNumber = SchoolBankAccount::find($request->input('bank_account_id'))->account_number;
            $currency = SchoolBankAccount::find($request->input('bank_account_id'))->currency;
            $user = request()->user()->ethics_user;

            $body = [

                "TellerEthixUsername" => strval($user),
                "schoolAccountNumber" => strval($schoolAccountNumber),
                "posTransactionReference" => $request->input('rrn'),
                "description" =>  $request->input('student_name')."|".$request->input('class')."|".$request->input('purpose'),
                "amount" => $request->input('amount'),
                "currency" => strval($currency),


            ];



            $response = Http::withHeaders($headers)
                ->post('http://10.50.30.88:10001/api/v1/payment-transfer/instruction', $body);

            $responseData = json_decode($response->body(), true);



            if ($responseData && isset($responseData['responseCode'])) {

                $paymentStatus = $responseData['responseCode'] === 0 ? 'Success' : 'Fail';
                $paymentSta = $responseData['uniqueReference'];

                Payment::create([
                    'paid_at' => Carbon::today()->toDateString(),
                    'school_id' => $request->input('school_id'),
                    'bank_account_id' => $request->input('bank_account_id'),
                    'branch_id' => $request->user()->branch->id,
                    'amount' => $request->input('amount'),
                    'student_name' => $request->input('student_name'),
                    'amount_in_words' => $request->input('amount_in_words'),
                    'currency_value' => SchoolBankAccount::findOrFail($request->input('bank_account_id'))->currency,
                    'reference_number' => $paymentSta,
                    'rrn' => $request->input('rrn'),
                    'payment_status' => $paymentStatus,
                    'customer_phone_number' => $request->input('customer_phone_number'),
                    'reg_number' => $request->input('reg_number'),
                    'semester' => $request->input('semester'),
                    'term' => $request->input('term'),
                    'depositor_name' => $request->input('depositor_name'),
                    'class' => $request->input('class'),
                    'year' => $request->input('year'),
                    'purpose' => $request->input('purpose'),
                    'status' => PaymentStatus::Captured,
                    'created_by' => request()->user()->id,
                    'modified_by' => request()->user()->id,

                ]);

                $currentDate = date('Y-m-d H:i:s');


                Http::withHeaders([
                    'AccessKey' => 'TESTING',
                    'Content-Type' => 'application/json',
                ])->post('http://api.zou.ac.zw/bank-service/post-transaction', [
                    "amount" => $request->input('amount'),
                    "bank_account_number" => strval($schoolAccountNumber),
                    "student_code" => $request->input('reg_number'),
                    "transaction_number" => $request->input('rrn'),
                    "branchdeposited" => "POSB",
                    "txntypecode" => "POS",
                    "txndate" => strval($currentDate),
                    "bankreference" => strval($paymentSta),
                    "currency" => strval(SchoolBankAccount::findOrFail($request->input('bank_account_id'))->currency),
                    "mti" => "",
                ]);



                $payment = Payment::where('created_by', request()->user()->id)->orderBy('id', 'DESC')->first();
                return redirect('payment/confirm/' . $payment->id);
                // return $responseData = $response1->body();
            } else {
                // Handle the case where the response does not contain a responseCode

                return $responseData;
            }
        }
    }

    public function confirmPayment($id)
    {
        $paymentReference = 'POSB-' . uniqid();
        $payment = Payment::findOrFail($id);
        return view('payments.confirm_payment', compact('payment', 'paymentReference'));
    }

    public function confirmedPayment($id)
    {
        $paymentReference = 'POSB-' . uniqid();
        $payment = Payment::findOrFail($id);
        return view('payments.confirmed_payment', compact('payment', 'paymentReference'));
    }





    //    PDF Generator Methods

    public function generatePDF($paymentId)
    {
        $payment = Payment::findOrFail($paymentId); // Replace with your model and logic

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $payment = Payment::findOrFail($paymentId);


        $dompdf = new Dompdf($options);

        $view = view('payments.pdf', compact('payment'));
        $htmlContent = $view->render();

        $dompdf->loadHtml($htmlContent);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $pdfPath = storage_path('app/temp/payment_invoice.pdf');
        Storage::put('temp/payment_invoice.pdf', $dompdf->output());

        return response()->download($pdfPath, 'payment_invoice.pdf');
    }

    public function generateReport($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        $view = view('reports.generate', compact('payment'));
        $htmlContent = $view->render();

        $dompdf->loadHtml($htmlContent);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $pdfPath = storage_path('app/temp/payment_invoice.pdf');
        Storage::put('temp/payment_invoice.pdf', $dompdf->output());

        return response()->download($pdfPath, $paymentId . $payment->student_name . '_INV.pdf');
    }


    public function displayReport(Request $request)
    {
        // Retrieve the list of schools for the dropdown
        $schools = DB::table('schools')->pluck('school_name', 'id');
        //dd($schools );
        // Get the input values from the request
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $school_id = $request->input('school');

        $selectedSchoolName = $schools->get($school_id);


        // Create Carbon instances for start and end dates
        $start_date1 = Carbon::parse($start_date)->startOfDay();
        $end_date1 = Carbon::parse($end_date)->endOfDay();

        // Initialize the query builder
        $query = Payment::query();

        // If a school is selected, filter by school
        if ($school_id) {
            $query->where('school_id', $school_id);
        }

        // If both start and end dates are provided, filter by date range
        if ($start_date && $end_date) {
            $query->whereBetween('paid_at', [$start_date1, $end_date1]);
        }

        // Retrieve the payments based on the applied filters
        $payments = $query->get();

        // Calculate the total payment amount
        $totalPaymentUSD = $payments->filter(function ($payment) {
            return $payment->currency_value === 'USD';
        })->sum('amount');
        $totalPaymentZWL = $payments->filter(function ($payment) {
            return $payment->currency_value === 'ZWL';
        })->sum('amount');

        return view('reports.index', compact('payments', 'schools', 'start_date', 'end_date', 'school_id', 'totalPaymentZWL', 'totalPaymentUSD', 'selectedSchoolName'));
    }

    public function getStudents()
    {
        $response = Http::withHeaders([
            'AccessKey' => 'TESTING',
        ])->get('http://api.zou.ac.zw/bank-service/get-students');

        $student_records = json_decode($response, true);

        if ($student_records) {
            foreach ($student_records as $student) {
                // Access student properties


                $firstname = $student['firstname'];
                $surname = $student['surname'];
                $studentcode = $student['studentcode'];
                $region = $student['region'];
                $zou_id = $student['id'];
                $mobilenumber = $student['mobilenumber'];

                // Do something with each student record here

                $studentexist = Student::where('studentcode', $studentcode)->first();
                if (!$studentexist) {

                    $student = new Student();
                    $student->firstname = $firstname;
                    $student->surname = $surname;
                    $student->studentcode = $studentcode;
                    $student->region =  $region;
                    $student->mobilenumber =  $mobilenumber;
                    $student->zou_id =  $zou_id;
                    $student->save();
                } else {

                    // $headers = [
                    //     'AccessKey' => 'TESTING',
                    //     'Content-Type' => 'application/json',
                    // ];

                    // $data = [
                    //     'studentCode' => $studentcode,
                    // ];

                    // $response = Http::withHeaders($headers)
                    //     ->post('http://api.zou.ac.zw/bank-service/update-sycnzed-student-status', $data);

                    // echo $studentcode;
                    echo "ZOU ID: $zou_id<br>";
                    echo "First Name: $firstname<br>";
                    echo "Surname: $surname<br>";
                    echo "Student Code: $studentcode<br>";
                    echo "Region: $region<br>";
                    echo "Mobile Number: $mobilenumber<br>";
                    echo "<hr>";
                }
            }
        } else {
            echo "No student records found in the response to update the database.";
        }
    }

    public function refreshStudents()
    {
        // Define the request headers
        $headers = [
            'AccessKey' => 'TESTING',
            'Content-Type' => 'application/json',
        ];

        // Define the batch size
        $batchSize = 5;
        $offset = 0;

        do {
            // Fetch the next batch of student records from the database
            $students = Student::skip($offset)->take($batchSize)->get();

            if (!$students->isEmpty()) {
                foreach ($students as $student) {
                    // Define the request body for the current student
                    $requestData = [
                        'studentCode' => $student->studentcode,
                    ];

                    // Make the POST request using Laravel's HTTP client
                    $response = Http::withHeaders($headers)
                        ->post('http://api.zou.ac.zw/bank-service/update-sycnzed-student-status', $requestData);

                    // Check the response and handle it accordingly
                    if ($response->successful()) {
                        // Success
                        echo "Success for student code: {$student->studentcode}\n";
                        echo $response->body() . "\n";
                    } else {
                        // Handle the error or retry if necessary
                        echo "Request failed for student code: {$student->studentcode}, Status: " . $response->status() . "\n";
                    }
                }
            } else {
                // Handle the case where there are no students in the database
                echo "No students found in the database.\n";
            }

            // Increment the offset to fetch the next batch of students in the next iteration
            $offset += $batchSize;
        } while (!$students->isEmpty());
    }





    public function submitPayment(Request $request)
    {


        $payment = Payment::findOrFail($request->input('payment_id'));


        if ($payment->status != PaymentStatus::Captured) {

            //We need a Job that calls the Ethix API Here

            //When Api call is done then we do the following

            //Send SMS to the phone number of the bursar and the customer phone number

            //            $basic  = new \Vonage\Client\Credentials\Basic("43f0efa6", "h5jN3EeZcB7MJAuB");
            //            $client = new \Vonage\Client($basic);
            //
            //            $response = $client->sms()->send(
            //                new \Vonage\SMS\Message\SMS("+263776969748", 'Posb Fees Payment', 'A text message sent using the Nexmo SMS API')
            //            );
            //
            //            $message = $response->current();
            //
            //            if ($message->getStatus() == 0) {
            //                dd("The message was sent successfully");
            //            } else {
            //                dd($message->getStatus());
            //            }

            return redirect('/payments')->with('message', 'Payment was sent and Processed');
        } else {
            return redirect()->back()->withErrors(['This payment cannot be processed at the moment, contact Support']);
        }
    }

    public function findSchoolIdByAccountNumber($bankAccount)
    {
        if ($bankAccount) {
            // Retrieve the school_id from the SchoolBankAccount
            return $bankAccount->school_id;
        }

        // Handle the case where the bank account is not found
        return null;
    }

    public function zssmakePayment(Request $request)
    {
        try {


            $accountNumber = $request->input('account_number');
            $bankAccount = SchoolBankAccount::where('account_number', $accountNumber)->first();



            $payment = new Payment;

            $payment->paid_at = Carbon::today()->toDateString();
            $payment->school_id = 1;
            $payment->bank_account_id = 1;
            $payment->branch_id = 1;
            $payment->amount = $request->input('amount');
            $payment->student_name = $request->input('student_name');
            $payment->amount_in_words = $request->input('amount_in_words');
            $payment->currency_value = 'ZWL';
            $payment->reference_number = $request->input('reference');
            $payment->rrn = $request->input('rrn');
            $payment->payment_status = $request->input('status');
            $payment->customer_phone_number = $request->input('customer_phone_number');
            $payment->reg_number = $request->input('reg_number');
            $payment->semester = $request->input('semester');
            $payment->term = $request->input('term');
            $payment->depositor_name = $request->input('depositor_name');
            $payment->class = $request->input('class');
            $payment->year = $request->input('year');
            $payment->purpose = $request->input('purpose');
            $payment->status = PaymentStatus::Captured;
            $payment->created_by = 1;
            $payment->modified_by = 1;

            $payment->save();
            return response()->json(['message' => 'Payment successful', 'payment' => $payment], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Payment failed successful', 'payment' => $e], 201);
        }
    }
    public function fetchAndEchoData()
    {
        $data = DB::connection('sqlsrv')->select('SELECT * FROM mta_portal_test');

        if (!empty($data)) {
            foreach ($data as $row) {
                // Assuming your_table has 'column_name' as one of the columns
                echo $row->column_name . "<br>";
            }
        } else {
            echo "No data found.";
        }
    }
}
