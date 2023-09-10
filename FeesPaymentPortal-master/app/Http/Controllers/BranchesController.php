<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Branch::paginate(4);
        return view('branches.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateWith([
            'branch_name' => 'required:string',
            'email'=> 'required:email',
            'mobile_number'=> 'required'
        ]);

        Branch::create([
                    'branch_name'=>$request->input('branch_name'),
                    'branch_address'=>$request->input('branch_address'),
                    'email'=>$request->input('email'),
                    'mobile_number'=>$request->input('mobile_number')
                   ]);
        return redirect('/branch')->with('message', 'Branch has been created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return view('branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update($id , Request $request)
    {
        $branch = Branch::findOrFail($id);
        $branch->branch_name = $request->input('branch_name');
        $branch->email = $request->input('email');
        $branch->mobile_number = $request->input('mobile_number');
        $branch->branch_address = $request->input('branch_address');
        $branch->save();
        return redirect('/branch')->with('message','Branch has been updated Successfully');
    }

    public function updatepayment($id , Request $request)
    {
        $branch = Branch::findOrFail($id);
        $branch->branch_name = $request->input('branch_name');
        $branch->email = $request->input('email');
        $branch->mobile_number = $request->input('mobile_number');
        $branch->branch_address = $request->input('branch_address');
        $branch->save();
        return redirect('/branch')->with('message','Branch has been updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
