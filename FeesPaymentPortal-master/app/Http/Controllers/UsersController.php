<?php

namespace App\Http\Controllers;

use App\Enum\UserType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
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

        $this->validateWith([
            'first_name' => 'required:string',
            'last_name' => 'required:string',
            'email' => 'required|email|unique:users,email',
            'branch'=> 'required',
            'ethics_user' =>'required',
        ]);
        $password  = $request->input('first_name').'@'.$request->input('last_name');


        $user= User::create([
            'ethics_user'=>$request->input('ethics_user'),
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'email'=>$request->input('email'),
            'branch_id'=>$request->input('branch'),
            'type'=>$request->input('user_type'),
            'password'=>Hash::make($password),
        ]);


// Mail::to($request->input('email'))->send(new WelcomeMail($request->input('email'), $password));

        if ($user) {
            // User was successfully created
            //  Mail::to($request->input('email'))->send(new WelcomeMail($request->input('email'), $password));

            return redirect('user')->with('message', 'New User has been created. An email was sent with a default password to the provided email');
        } else {
            // User creation failed
            // Handle the error or provide feedback to the user.
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
