<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EthixTransaction;

class EthixTransactionController extends Controller
{
    //
    public function create(Request $request)
    {
        $transaction = EthixTransaction::create([
            'TellerEthixUsername' => strval($request->user),
            'schoolAccountNumber' => strval($request->schoolAccountNumber),
            'posTransactionReference' => 'CASH-REMITANCE' . Str::random(9),
            'description' => $request->senderFirstName . " " . $request->senderLastName . " Send " . $request->principal_amount . " To " . $request->recipientFirstName . " " . $request->recipientLastName . " Country: " . $request->receiver['fxrate']['country'],
            'amount' => $request->principal_amount,
            'currency' => strval($request->currency),
            'status' => 'pending',
        ]);

        return response()->json($transaction, 201);
    }
}
