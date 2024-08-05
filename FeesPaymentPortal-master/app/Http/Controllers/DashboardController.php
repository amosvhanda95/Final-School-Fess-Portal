<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Jobs\Slowjob;
use App\Models\School;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function dashboard()

    
    {
        Slowjob::dispatch();
        $totalRolls = Payment::count();
        $totalSchools = School::count();
        $totalUsers = User::count();
        return view('dashboard',[
            'totalRolls' => $totalRolls,
            'totalSchools' => $totalSchools,
            'totalUsers' =>$totalUsers,
        ]);
    }
   

}

