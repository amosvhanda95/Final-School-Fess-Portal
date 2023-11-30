<?php

namespace App\Http\Controllers;

use App\Models\Fxrate;
use App\Models\Customer;
use App\Models\Beneficiary;
use Illuminate\Http\Request;
use App\Http\Requests\InternationBankValidationRequest;

class BeneficiaryController extends Controller
{
    public function index()
    {
        $customer = Beneficiary::paginate(4);
       

        return view('beneficiaries.index', compact('customer',));
    }
    
    public function create()
    {
        // Retrieve a list of senders to populate the dropdown select
        $senders = Customer::all();
        $fxRates = Fxrate::all();

        return view('beneficiaries.create', compact('senders','fxRates'));
    }
    public function create1()
    {
        // Retrieve a list of senders to populate the dropdown select
        $senders = Customer::all();
        $fxRates = Fxrate::all();

        return view('beneficiaries.create', compact('senders','fxRates'));
    }

     public function store(InternationBankValidationRequest $request)
    //  public function store(Request $request)
    {
    //    dd($request);
        
        session(['selectedCountry' => $request->input('country_id')]);
       
        $request->validate([
            
            'rec_first_name' => 'required',
            "rec_surname" => 'required',
            "rec_house_number" => 'required',
            "rec_area" => 'required',
            "rec_city" => 'required',
            "country_id" => 'required',
            'customer_id' => 'required|exists:customers,id',
            'currency'=> 'required',

        ]);

        // Create a new Beneficiary instance and save it to the database
        
        $id2 = Fxrate::where('country_code', $request ->country_id)->first();
       

        if ($id2) {
            $fxRateId = $id2->id;
        } else {
            // Handle the case where the FxRate with the specified country code is not found.
        }

        Beneficiary::create([
            'rec_first_name' => $request->rec_first_name,
            "rec_surname" => $request->rec_surname,
            "rec_house_number" => $request->rec_house_number,
            "rec_ban" => $request->rec_ban,
            "rec_pan" => $request->rec_pan,
            "rec_bic" => $request->rec_bic,
            "rec_ewallet"=> $request->rec_ewallet,
            "rec_middle_name" => $request->rec_middle_name,
            "payer_payee_relationship" => $request->payer_payee_relationship,
            "rec_postal_code" => $request->rec_postal_code,
            "rec_area" => $request->rec_area,
            "rec_city" => $request->rec_city,
            "rec_country_subdivision" => $request->rec_country_subdivision,
            "country_id" =>   $fxRateId ,
            'customer_id' => $request->customer_id,
            'recipient_account_uri'=> $request->recipient_account_uri,
            'id_expiration_date'=> $request->id_expiration_date,
            'rec_idc'=> $request->rec_idc,
            'rec_email'=> $request->rec_email,
            'rec_iban'=> $request->rec_iban,
            'rec_bank_name' => $request->rec_bank_name,
            'rec_bank_type'=> $request->rec_bank_type,
            'rec_bank_code'=> $request->rec_bank_code,
            'payment_method'=> $request->payment_method,
            'currency' => $request->currency,
            //add rec_email and rec_iban on create
            
        ]);

        return redirect()->route('beneficiary.index')
            ->with('success', 'Beneficiary added successfully');
    }

    public function show(Beneficiary $beneficiary)
    {
        
        return view('beneficiaries.show', ['beneficiary' => $beneficiary]);
    }
    public function edit(Beneficiary $beneficiary)
    {
        $fxRates = Fxrate::all();
        return view('beneficiaries.edit', compact('beneficiary','fxRates'));
    }
    public function update($id , Request $request)
    {
        // dd($request);
        
        $branch = Beneficiary::findOrFail($id);
        $branch->recipient_account_uri = $request->input('recipient_account_uri');
        $branch->rec_first_name = $request->input('first_name');
        $branch->rec_surname = $request->input('surname');
        $branch->rec_house_number = $request->input('rec_house_number');
        $branch->rec_area = $request->input('rec_area');
        $branch->rec_city = $request->input('rec_city');
        $branch->rec_city = $request->input('country_id');

        
        
        $branch->save();
        return redirect('/beneficiary')->with('message','Beneficiary has been updated Successfully');
    }
}
