<?php

namespace App\Http\Controllers;
use App\Models\School;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function dashboard()
    {
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
