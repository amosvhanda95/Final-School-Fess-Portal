<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;

class PassportClientController extends Controller
{
    public function getToken(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);

        $client = Client::where('id', $request->client_id)
            ->where('secret', $request->client_secret)
            ->first();
            if(Auth::once(($client))){
              $user =Auth::user();

            }

        if (!$client) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = $user->createToken('SchoolToken')->accessToken;

        return response()->json(['access_token' => $token]);
    }
   
}





 
