<?php

use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BursarController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\CrossborderPaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PassportClientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// routes/web.php

Route::get('/generate-report', [PaymentsController::class, 'displayReport']);
Route::post('/reports/get', [PaymentsController::class, 'displayReport']);


Route::redirect('/', '/auth/login');
Route::post('/get-token', [PassportClientController::class,'getToken']);

// Show the forgot password form
Route::get('/auth/forgot_password', [ForgotPasswordController::class, 'showForgotPasswordForm']);

// Handle the submission of the forgot password form
Route::post('/auth/forgot_password', [ForgotPasswordController::class, 'resetPassword']);


Route::get('auth/login',  ['\App\Http\Controllers\Auth\AuthController', 'show'])->name('auth.login');
Route::post('auth/login',  ['\App\Http\Controllers\Auth\AuthController', 'login']);
Route::group(['middleware'=>'auth'], function () {
        Route::get('dashboard', ['\App\Http\Controllers\DashboardController', 'dashboard']);
        Route::resource('user', UsersController::class);
        Route::resource('branch', BranchesController::class);
        Route::post('bursars/{id}/edit', [BursarController::class,'update']);
        Route::resource('bursar', BursarController::class);
        Route::resource('school', SchoolsController::class);
        Route::delete('/schools/{school}', [SchoolsController::class,'destroy']);
        Route::delete('/banck_account/{account}', [SchoolsController::class,'destroyBank']);
        Route::get('/banck_account/{account}/edit', [SchoolsController::class,'editbank']);
        Route::post('/bank_account/{account}/edit', [SchoolsController::class,'updatebank']);
        Route::post('edit_user/{id}/edit', ['\App\Http\Controllers\UsersController', 'update']);
        Route::post('edit_branch/{id}/edit', ['\App\Http\Controllers\BranchesController', 'update']);
        Route::post('edit_payment/{id}/edit', ['\App\Http\Controllers\BranchesController', 'updatepayment']);
        Route::post('edit_school/{id}/edit', ['\App\Http\Controllers\SchoolsController', 'update']);
        Route::post('branch/delete/{id}', ['\App\Http\Controllers\BranchesController', 'destroy']);
        Route::get('auth/logout',  ['\App\Http\Controllers\Auth\AuthController', 'logout'])->name('auth.logout');
        Route::get('school/bank_account/create',  ['\App\Http\Controllers\SchoolsController', 'createSchoolBankAccount']);
        Route::post('school/bank_account/',  ['\App\Http\Controllers\SchoolsController', 'saveSchoolBankAccount']);
        Route::get('bank_account',  ['\App\Http\Controllers\SchoolsController', 'getSchoolBankAccounts']);
        Route::get('bursar',  ['\App\Http\Controllers\SchoolsController', 'showBursar']);
        Route::post('bursar',  ['\App\Http\Controllers\SchoolsController', 'saveBursar']);
        Route::get('bursars',  ['\App\Http\Controllers\SchoolsController', 'getBursars']);
        Route::get('payment/create', ['\App\Http\Controllers\PaymentsController', 'show']);

        Route::get('/payment/zou', ['\App\Http\Controllers\PaymentsController', 'zolshow']);

        Route::post('payment/account_search', ['\App\Http\Controllers\PaymentsController', 'accountSearch']);
        Route::post('payment/id_account_search', ['\App\Http\Controllers\PaymentsController', 'idaccountSearch']);
        Route::get('payment/capture_details/{id}', ['\App\Http\Controllers\PaymentsController', 'captureDetails']);
        Route::get('payment/capture_details/{id}/{id1}', ['\App\Http\Controllers\PaymentsController', 'zoucaptureDetails']);
        Route::get('payment/edit_capture_details/{id}', ['\App\Http\Controllers\PaymentsController', 'ediDetails']);

        Route::post('payment/make_payment', ['\App\Http\Controllers\PaymentsController', 'makePayment']);
        Route::post('payment/zoumake_payment', ['\App\Http\Controllers\PaymentsController', 'zoumakePayment']);
        Route::get('payment/confirm/{id}', ['\App\Http\Controllers\PaymentsController', 'confirmPayment'] );
        Route::get('payment/confirmed/{id}', ['\App\Http\Controllers\PaymentsController', 'confirmedPayment'] );
        Route::post('payment/submit_payment/{id}', ['\App\Http\Controllers\PaymentsController', 'submitPayment'])->name('payment.submit_payment');
        
        Route::get('payments', ['\App\Http\Controllers\PaymentsController', 'index']);
        Route::get('clients', ['\App\Http\Controllers\ClientsController', 'index']);
        Route::delete('/oauth/clients/{id}',['\App\Http\Controllers\ClientsController','deleteClient'] )->middleware('auth:api');

        Route::get('/bank_details/{school}', [SchoolsController::class,'bankDetails']);
        Route::get('/school_details/{school}', [SchoolsController::class,'showschool']);
        Route::get('/payment/{payment}', [PaymentsController::class,'generatePDF']);
        Route::get('/reports/{payment}', [PaymentsController::class,'generateReport']);

        Route::get('/get-students', [PaymentsController::class, 'getStudents']);
        Route::get('/get-updatestudents', [PaymentsController::class, 'refreshStudents']);
        Route::resource('customer', CustomerController::class);
        Route::resource('/beneficiaries', BeneficiaryController::class);
        Route::post('edit_beneficiary/{id}/edit', ['\App\Http\Controllers\BeneficiaryController', 'update']);
        Route::resource('crossboader-payment', CrossborderPaymentController::class);
        Route::post('edit_customer/{id}/edit', ['\App\Http\Controllers\CustomerController', 'update']);
        Route::resource('crossboarder', APIController::class);
        Route::post('/crossboarder/capture', [APIController::class, 'searchByIdNumber']);
        Route::get('/crossboarder/capture_details/{id}', [APIController::class, 'captureDetails']);
        Route::post('/crossboarder/proceed/', [APIController::class, 'proceedRequest']);
        Route::post('/payment/submit_payment', [APIController::class, 'paymentRequest']);
        
       
});


Route::get('/cross/rates', [APIController::class, 'ratesRequest']);
        
        
       