<?php

namespace App\Http\Controllers;

use App\Models\SchoolBursar;
use Illuminate\Http\Request;

class BursarController extends Controller
{
    public function index()
    {
        $data = SchoolBursar::paginate(4);
        return view('schools.bursars.show', compact('data'));
    }
    public function show($id)
    {
        $bursar = SchoolBursar::findOrFail($id);
        return view('schools.bursars.show', compact('bursar'));
    }

    public function edit(SchoolBursar $bursar)
    {
        return view('schools.bursars.edit', compact('bursar'));
    }

    public function update($id , Request $request)
    {
        $branch = SchoolBursar::findOrFail($id);
        $branch->full_name = $request->input('full_name');
        $branch->mobile_number = $request->input('mobile_number');

        $branch->save();
        return redirect('/bursars')->with('message','Bursar has been updated Successfully');
    }
    
}
