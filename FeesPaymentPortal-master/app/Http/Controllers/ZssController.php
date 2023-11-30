<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Zsspayment;
use App\Enum\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Student;

class ZssController extends Controller
{
    public function update(Request $request) {
        try {
            $Zsspayment = new Zsspayment;
            $Zsspayment->name = $request->name;
            $Zsspayment->surname = $request->surname;
            $Zsspayment->regnumber = $request->regnumber;
            $Zsspayment->amount = $request->amount;
            $Zsspayment->refference = $request->refference;
            $Zsspayment->status = $request->status;
            $Zsspayment->year = $request->year;
            $Zsspayment->purpose = $request->purpose;
            $Zsspayment->semester = $request->semester;
            $Zsspayment->bank_account_number = $request->bank_account_number;
            $Zsspayment->currency = $request->currency;
            $Zsspayment->transaction_number = $request->transaction_number;
            $Zsspayment->created_at = Carbon::now(); // Use now() to set the current timestamp
            $Zsspayment->updated_at = Carbon::now(); // Use now() to set the current timestamp
            $Zsspayment->save();
    
            return response()->json([
                "status" => "success",
                "message" => "Student created successfully", // Corrected the typo
                'student' => $Zsspayment,
            ]);
        } catch (\Exception $th) {
            return response()->json([
                "status" => "error", // Changed 201 to "error"
                "message" => "Student Not created", // Corrected the typo
                'student' => $Zsspayment,
                'Error' => $th->getMessage(),
            ]);
        }
    }
}
