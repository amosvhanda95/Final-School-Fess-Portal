<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Beneficiary;
use App\Models\FXRate;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
    //    dd($request);
        $request->validate([
            'recipient_account_uri'=> 'required',
            'rec_first_name' => 'required',
            "rec_surname" => 'required',
            "rec_house_number" => 'required',
            "rec_area" => 'required',
            "rec_city" => 'required',
            "country_id" => 'required',
            'customer_id' => 'required|exists:customers,id',

        ]);

        // Create a new Beneficiary instance and save it to the database
        


        Beneficiary::create([
            'rec_first_name' => $request->rec_first_name,
            "rec_surname" => $request->rec_surname,
            "rec_house_number" => $request->rec_house_number,
            "rec_area" => $request->rec_area,
            "rec_city" => $request->rec_city,
            "country_id" => $request ->country_id,
            'customer_id' => $request->customer_id,
            'recipient_account_uri'=> $request->recipient_account_uri,
        ]);

        return redirect()->route('beneficiaries.index')
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
        return redirect('/beneficiaries')->with('message','Beneficiary has been updated Successfully');
    }
}
