<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\SchoolBursar;
use Illuminate\Http\Request;
use App\Models\SchoolBankAccount;


class SchoolsController extends Controller
{

    public function index()
    {
        $data = School::paginate(5);

        return view('schools.index', compact('data'));
    }

    public function create()
    {
         return view('schools.create');
    }

    public function createSchoolBankAccount()
    {
        return view('schools_bank_accounts.create');
    }

    public function saveSchoolBankAccount(Request $request)
    {
        $this->validateWith([
            'school_id' => 'required',
            'account_number'=> 'required:numeric | unique:school_bank_accounts',
            'currency'=>'required'
        ]);

        $status  = $request->input('status') == 'true' ? true : false;

        SchoolBankAccount::create([
            'school_id'=>$request->input('school_id'),
            'account_number'=>$request->input('account_number'),
            'currency'=>$request->input('currency'),
            'status' => $status,
            'created_by'=>request()->user()->id,
            'modified_by'=>request()->user()->id
        ]);

        return redirect('/bank_account')->with('message', 'School Bank Account has been created Successfully');

    }

    public function showBursar()
    {
        return view('schools.bursars.create');
    }

    public function showSchoolname()
    {
        return view('schools.registered.create');
    }

    public function getSchoolBankAccounts()
    {
        $data = SchoolBankAccount::paginate(5);
        return view('schools_bank_accounts.index', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validateWith([
            'school_name' =>'required|string|max:255|unique:schools',
            'school_type' => 'required|in:university,high_school',
            'status' =>'required',
            'email' => 'required|email|unique:schools,email',
            'mobile_number'=> 'required|unique:schools|',
        ]);

        $status  = $request->input('status') == 'true' ? true : false;
        School::create([
            'school_name'=>$request->input('school_name'),
            'school_type'=>$request->input('school_type'),
            'status' => $status,
            'email'=>$request->input('email'),
            'mobile_number'=>$request->input('mobile_number'),
            'created_by'=>request()->user()->id,
            'modified_by'=>request()->user()->id
        ]);

       return redirect('school')->with('message', 'School has been created Successfully');

    }
    public function saveBursar(Request $request)
    {
        $this->validateWith([
            'school_id' => 'required:string',
            'mobile_number'=> 'required'
        ]);

        $status  = $request->input('status') == 'true' ? true : false;
        SchoolBursar::create([
            'school_id'=>$request->input('school_id'),
            'full_name'=>$request->input('full_name'),
            'mobile_number'=>$request->input('mobile_number'),
            'status' => $status
        ]);

        return redirect('/bursars')->with('message', 'Bursar has been created Successfully');
    }

    public function getBursars()
    {
        $data = SchoolBursar::paginate(5);

        return view('schools.bursars.index', compact('data'));
    }

    public function show($id)
    {
        //
    }
    public function bankDetails( $id)
    {
        $school = School::with('bankAccounts')->findOrFail($id);
        
        return view('schools_bank_accounts.view',compact('school')); 
    }
    

    public function edit(School $school)
    {
        return view('schools.edit', compact('school'));
    }
    

    public function update(Request $request, $id)
    {
        //
        $school = School::findOrFail($id);
        $school->school_name = $request->input('school_name');
        $school->school_type = $request->input('school_type');
        $school->email = strtolower($request->input('email'));
        $school->mobile_number = $request->input('mobile_number');
        $school->status = $request->input('status');
        $school->save();
        return redirect('/school')->with('message','School has been updated Successfully');
    }

    public function destroy(School $school)
    {

    if (!$school) {
        return redirect('/school')->with('error', 'School not found.');
    }

    $school->delete();

    return redirect('school')->with('success', 'School deleted successfully.');
    }
    public function showschool($id)
    {
        $school = School::findOrFail($id);
        return view('schools.view', compact('school'));
    } 

    
    public function destroyBank(SchoolBankAccount $account)
    {

    if (!$account) {
        return redirect('/bank_account')->with('error', 'School not found.');
    }

    $account->delete();

    return redirect('/bank_account')->with('success', 'School deleted successfully.');
    }
  
    
    public function editbank(SchoolBankAccount $account)
    {
        //
        return view('schools_bank_accounts.edit', compact('account'));
    }
    public function updatebank($id , Request $request)
    {
        $branch = SchoolBankAccount::findOrFail($id);
        
        $branch->school_id = $request->input('school_id');
        $branch->status = $request->input('status');
        $branch->currency = $request->input('currency');
        $branch->account_number = $request->input('account_number');
        $branch->save();
        return redirect('/bank_account')->with('message','Account has been updated Successfully');
    }
}
