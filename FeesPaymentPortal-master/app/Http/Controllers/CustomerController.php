<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::paginate(4);
        return view('customers.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            
            'first_name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'date_of_birth' => 'required|string|max:255',
            'house_number' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'id_number' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            
            // Add validation rules for other fields
        ]);

        // Create a new customer record
        $customer = new Customer($validatedData);
        $customer->save();

        return redirect('/customer')->with('message', 'Customer has been created Successfully');
    }


    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.show', compact('customer'));
    }

    
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    
    public function update($id , Request $request)
    {
        $customer = Customer::findOrFail($id);
        $customer->first_name = $request->input('first_name');
        $customer->surname = $request->input('surname');
        $customer->id_number = $request->input('id_number');
        $customer->date_of_birth = $request->input('date_of_birth');
        $customer->phone_number = $request->input('phone_number');
        $customer->house_number = $request->input('house_number');
        $customer->area = $request->input('area');
        $customer->city = $request->input('city');
        $customer->save();
        return redirect('/customer')->with('message','Customer has been updated Successfully');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $branch)
    {
        //
    }
    //
      

    

    
}
