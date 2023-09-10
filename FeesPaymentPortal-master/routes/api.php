<?php

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\PaymentResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/{id}', function (string $id) {
    return new UserResource(User::findOrFail($id));
});

//api for all users
Route::get('/users', function () {
    return UserResource::collection(User::all()->keyBy->id);
});

Route::get('/payments/{id}', function (string $id) {
    return PaymentResource::collection(Payment::where('school_id', $id)->get()->keyBy->id) ;
});