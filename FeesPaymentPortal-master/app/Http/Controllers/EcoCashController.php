<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EcoCashController extends Controller
{
    
    public function index()
    {
        // Add logic to fetch data and pass it to the view if needed
        return view('ecocash.index');
    }

    public function create()
    {
        return view('ecocash.create');
    }
}
