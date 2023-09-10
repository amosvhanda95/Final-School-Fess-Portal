<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Laravel\Passport\Client;


class ClientsController extends Controller
{
    //
    public function index(Request $request)
    {
       $clients = $request->user()->clients;

        return view('clients.create',compact('clients'));
    }
    
    public function deleteClient( Client $client , Request $request)
    {

        
    
        $client->delete();
    
        return response()->json(['message' => 'Client deleted.']);
    }
    

}




