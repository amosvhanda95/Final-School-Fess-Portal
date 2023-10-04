<?php

namespace App\Http\Controllers;

use App\Models\Sendmoney;
use Illuminate\Http\Request;

class CrossborderPaymentController extends Controller
{
    public function index( )

    {
        $data = Sendmoney::orderBy('created_at', 'desc')->paginate(10);
        return view('crossboarder.payment.index', compact('data'));  
    }

  

    public function show(Sendmoney $sendmoney)
    {
        
        return view('crossboarder.payment.show', ['sendmoney' => $sendmoney]); 
    }
}
