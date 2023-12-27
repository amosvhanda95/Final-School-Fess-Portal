<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanApplication;

class LoanApplicationController extends Controller
{
    //
    public function create()
    {
        {
            // Pass loan types to the view
            $loanTypes = ['Personal Loan', 'Home Loan', 'Car Loan', 'Business Loan'];
            return view('loan-application.create', compact('loanTypes'));
        }
    }
    public function store(Request $request)
    {
        // Add validation logic for loan application form data
        $request->validate([
            'loan_type' => 'required|string',
            'amount' => 'required|numeric',
            'term_months' => 'required|integer',
            'interest_rate' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        // Save the loan application to the database or perform other actions
        // ...

        // Redirect back to the form with a success message
        return redirect()->route('loan-application.create')->with('success', 'Loan application submitted successfully!');
    }

    public function index()
    {
        $loanApplications = LoanApplication::all();
        return view('loan-application.index', compact('loanApplications'));
    }

}
