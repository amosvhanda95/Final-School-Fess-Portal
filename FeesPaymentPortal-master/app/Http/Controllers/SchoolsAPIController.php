<?php

namespace App\Http\Controllers;
use App\Models\School;


class SchoolsAPIController extends Controller
{
    //

    function getSchools(){

        $data = 
            School::where('school_type', 'high_school')->get()
            ;

        return response()->json($data);
    }
}
