<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use App\Models\School;
use App\Models\Payment;
use App\Enum\PaymentStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SchoolBankAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
            'account_number'=>'required:numeric'
        ]);

        $accountNumber = $request->input('account_number');
        $bankAccount = SchoolBankAccount::where('account_number', $accountNumber)
        ->where('status', '1')->first();
        if(!is_null($bankAccount)) {
            return redirect('payment/capture_details/' . $bankAccount->id)->with('message', 'Bank Account found, now you can proceed');
        }
        else
        {
            return redirect()->back()->withErrors(['Bank Account number is Invalid, please check on the deposit slip and try again, If the problem persists contact support']);
        }
    }

    public function idaccountSearch(Request $request)
    {
        $this->validateWith([
            'account_number'=>'required:numeric',
            'reg_number'=>'required'

        ]);
        // dd($request);

        $accountNumber = $request->input('account_number');
        $RegNumber = $request->input('reg_number');
        $bankAccount = SchoolBankAccount::where('account_number', $accountNumber)->first();
        //change here to find the student in the data base 
        $RegAccount = Payment::where('reg_number', $RegNumber)->first();
        if(!is_null($bankAccount)& !is_null($RegAccount) ) {
            return redirect('payment/capture_details/' . $bankAccount->id.'/'. $RegAccount ->id)->with('message', 'Bank Account found, now you can proceed');
        }
        else
        {
            return redirect()->back()->withErrors(['Bank Account or Reg Number number is Invalid, please check on the deposit slip and try again, If the problem persists contact support']);
        }
    }
    public function captureDetails($bankDetailsId)
    {
        if (is_null($bankDetailsId))
        {
            redirect('payment/create')->withErrors(['You had skipped this stage']);
        }
        else
        {
            $bankAccount = SchoolBankAccount::findOrFail($bankDetailsId);
           return view('payments.capture_details', compact('bankAccount'));
        }
    }
    public function zoucaptureDetails($bankDetailsId, $Stdid)
    {
        if (is_null($bankDetailsId))
        {
            redirect('payment/create')->withErrors(['You had skipped this stage']);
        }
        else
        {
            $bankAccount = SchoolBankAccount::findOrFail($bankDetailsId);
            //Change to match the students table
            $Student = Payment::findOrFail($Stdid);
           return view('payments.zoucapture_details', compact('bankAccount','Student'));
        }
    }
    public function ediDetails($bankDetailsId)
    {
        if (is_null($bankDetailsId))
        {
            redirect('payment/create')->withErrors(['You had skipped this stage']);
        }
        else
        {
            $bankAccount = Payment::findOrFail($bankDetailsId);
           return view('payments.edit', compact('bankAccount'));
        }
    }
    
 public function makePayment(Request $request)


    {
        
        $this->validateWith([

            'amount'=>'numeric:required',
            'amount_in_words'=>'required',
            'year'=>'required',
            'customer_phone_number'=>'required',
        ]);
        

$headers = [
    'Content-Type' => 'application/json',
    'x-api-key' => '93c5ad2a-94d1-43b9-a8ef-177329cf528a',
    'x-trace-id' => 'POSB-' . uniqid()
    ,
];
$schoolAccountNumber= SchoolBankAccount::find($request->input('bank_account_id'))->account_number ;
$currency=SchoolBankAccount::find($request->input('bank_account_id'))->currency ;
$user = request()->user()->first_name ;

$body = [

    "TellerEthixUsername" => strval($user ) ,
    "schoolAccountNumber" =>strval($schoolAccountNumber)   ,
    "posTransactionReference" => $request->input('rrn'),
    "description" => $request->input('purpose'),
    "amount" => $request->input('amount'),
    "currency" => strval($currency) ,

  

];






$response = Http::withHeaders($headers)
    ->post('http://10.50.30.88:10001/api/v1/payment-transfer/instruction', $body);

    $responseData = json_decode($response->body(), true);

   

    if ($responseData && isset($responseData['responseCode'])) {

        $paymentStatus = $responseData['responseCode'] === 0 ? 'Success' : 'Fail';
        $paymentSta = $responseData['uniqueReference'];
        
        Payment::create([
            'paid_at' => Carbon::today()->toDateString(),
            'school_id'=>$request->input('school_id'),
            'bank_account_id'=>$request->input('bank_account_id'),
            'branch_id'=>$request->user()->branch->id,
            'amount'=> $request->input('amount'),
            'student_name'=> $request->input('student_name'),
            'amount_in_words'=> $request->input('amount_in_words'),
            'currency_value'=> SchoolBankAccount::findOrFail($request->input('bank_account_id'))->currency,
            'currency'=>$paymentStatus,
            'rrn'=> $request->input('rrn'),
            'payment_status' => $paymentSta,
            'customer_phone_number'=> $request->input('customer_phone_number'),
            'reg_number'=> $request->input('reg_number'),
            'semester'=> $request->input('semester'),
            'term'=> $request->input('term'),
            'depositor_name'=>$request->input('depositor_name'),
            'class'=> $request->input('class'),
            'year'=> $request->input('year'),
            'purpose'=> $request->input('purpose'),
            'status'=> PaymentStatus::Captured,
            'created_by'=>request()->user()->id,
            'modified_by'=> request()->user()->id,

        ]);
        
        $payment = Payment::where('created_by',request()->user()->id)->orderBy('id', 'DESC')->first();
        return redirect('payment/confirm/'. $payment->id);
        
    } else {
        // Handle the case where the response does not contain a responseCode
       
        return redirect()->back()
        ->withErrors(['message', "Error Code" . $responseData['code'] ]);
    } 

 
        
    }

    public function confirmPayment($id)
    {
        $paymentReference = 'POSB-' . uniqid();
        $payment = Payment::findOrFail($id);
        return view('payments.confirm_payment', compact('payment','paymentReference'));
    }

    public function confirmedPayment($id)
    {
        $paymentReference = 'POSB-' . uniqid();
        $payment = Payment::findOrFail($id);
        return view('payments.confirmed_payment', compact('payment','paymentReference'));
    }

    



//    PDF Generator Methods
    
    // public function generatePDF($paymentId)
    // {
    //     $payment = Payment::findOrFail($paymentId); // Replace with your model and logic
    
    //     $options = new Options();
    //     $options->set('isHtml5ParserEnabled', true);
    //     $options->set('isRemoteEnabled', true);
    
    //     $payment = Payment::findOrFail($paymentId);
     

    //     $dompdf = new Dompdf($options);
    
    //     $view = view('payments.pdf', compact('payment'));
    //     $htmlContent = $view->render();
       
    //     $dompdf->loadHtml($htmlContent);
    
    //     $dompdf->setPaper('A4', 'portrait');
    
    //     $dompdf->render();
    
    //     $pdfPath = storage_path('app/temp/payment_invoice.pdf');
    //     Storage::put('temp/payment_invoice.pdf', $dompdf->output());
    
    //     return response()->download($pdfPath, 'payment_invoice.pdf');
    // }
    
    // public function generateReport($paymentId)
    // {
    //     $payment = Payment::findOrFail($paymentId);
    //     $options = new Options();
    //     $options->set('isHtml5ParserEnabled', true);
    //     $options->set('isRemoteEnabled', true);

    //     $dompdf = new Dompdf($options);
    
    //     $view = view('reports.generate',compact('payment'));
    //     $htmlContent = $view->render();
       
    //     $dompdf->loadHtml($htmlContent);
    
    //     $dompdf->setPaper('A4', 'portrait');
    
    //     $dompdf->render();
    
    //     $pdfPath = storage_path('app/temp/payment_invoice.pdf');
    //     Storage::put('temp/payment_invoice.pdf', $dompdf->output());
    
    //     return response()->download($pdfPath, $paymentId. $payment->student_name.'_INV.pdf');
    // }
       
    
    public function displayReport(Request $request)
    {
        // Retrieve the list of schools for the dropdown
        $schools = DB::table('schools')->pluck('school_name', 'id');
        
        // Get the input values from the request
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $school_id = $request->input('school');
    
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
        $totalPayment = $payments->sum('amount');
    
        return view('reports.index', compact('payments', 'schools', 'start_date', 'end_date', 'school_id', 'totalPayment'));
    }
    
        
        


    public function submitPayment(Request $request)
    {

        $payment = Payment::findOrFail($request->input('payment_id'));
       

        if($payment->status != PaymentStatus::Captured)
        {

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
        }
        else
        {
            return redirect()->back()->withErrors(['This payment cannot be processed at the moment, contact Support']);
        }
    }

}
