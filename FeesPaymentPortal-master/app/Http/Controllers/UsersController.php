<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enum\UserType;
use App\Mail\WelcomeMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $data = User::orderBy('created_at', 'desc')->paginate(10);
        return view('users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */


     public function store(Request $request)
{
    $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'branch' => 'required',
        'user_type' => 'required',
    ];

    // Check user type
    if ($request->input('user_type') == 5) {
        // If user type is 5, add validation for account_number
        $rules['account_number'] = 'required|string|unique:users,account_number';
    } else {
        // If user type is not 5, add validation for ethics_user
        $rules['ethics_user'] = 'required|string|unique:users,ethics_user';
    }

    $this->validate($request, $rules);

    $password = $request->input('first_name') . '@' . $request->input('last_name');

    $token = Str::random(64);
    DB::table('password_resets')->insert([
        'email' => $request->email,
        'token' => $token,
        'created_at' => Carbon::now(),
    ]);

    $user = User::create([
        'ethics_user' => $request->input('ethics_user'),
        'account_number' => $request->input('account_number'),
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'email' => $request->input('email'),
        'branch_id' => $request->input('branch'),
        'type' => $request->input('user_type'),
        'password' => Hash::make($password),
    ]);
    

    if ($user) {
        Mail::send('emails.welcome', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Reset Password');
        });

        return redirect('user')->with('message', 'New User has been created. A password reset link has been sent to the provided email.');

    } else {
        return redirect('user')->with('error', 'User creation failed.');
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('users.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update($id , Request $request)
    {
        
        $user = User::findOrFail($id);
        $user->ethics_user = $request->input('ethics_user');
        $user->first_name = $request->input('first_name');
        $user->email = $request->input('email');
        $user->last_name = $request->input('last_name');
        $user->type = $request->input('type');
        $user->save();
        return redirect('/user')->with('message','User has been updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
