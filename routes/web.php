<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//Route::post('/payments/create-paypal-transaction', 'Payments\Paypal\PaypalController@makePayment');
Route::view('/', 'lp.main')->name('main');
Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/register', function () {
        return view('auth.register', ['otp_time' => RegisterController::OTP_TIME]);
    })->name('register');
    Route::post('/register', 'Auth\RegisterController@register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::post('/sendOtp', 'Auth\RegisterController@sendOtp')->middleware('auth');
    Route::post('/validate-otp', 'Auth\RegisterController@validateOtp')->middleware('auth');
    Route::get('/sendMail', 'MailController@send_mail');
});

Route::middleware(['user.verification'])->group(function () {
    Route::get('/otp', function () {
        return view('auth.otp', [
            'otp_time' => RegisterController::OTP_TIME,
            'mail_id' => Auth::user()->email
        ]);
    })->name('otp')->middleware('user.verification');
    Route::get('/plans', 'Auth\RegisterController@renderPlansView')->name('plans');
    Route::get('/home/{appPath?}', 'HomeController@index')->where('appPath', '[A-Za-z-]+');


    /*****************************************************************************************************************************
     *****************************************              Admin routes            **********************************************
     ****************************************************************************************************************************/
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::view('/', 'admin.home')->name('home');

        Route::get('tags', 'TagController@getAllTags');
        Route::get('search-tag', 'TagController@getLikeTags');
        Route::post('save-tag', 'TagController@saveTag');

        Route::prefix('prelims')->group(function () {
            Route::get('create-mcq', 'PrelimsController@renderCreateMcqView')->name('create-mcq');
            Route::get('get-mcqs', 'PrelimsController@getMcqs');
            Route::get('manage-mcq', 'PrelimsController@renderManageMcqView')->name('manage-mcq');
            Route::get('get-syllabus', 'PrelimsController@getPrelimsSyllabus')->name('syllabus');
            Route::post('upload-mcq-image', 'PrelimsController@saveMcqImage')->name('upload-mcq-image');
            Route::post('create-mcq', 'PrelimsController@createMcq')->name('create-mcq');
            Route::get('edit-mcq/{id}', 'PrelimsController@editMcq')->name('edit-mcq');
            Route::post('update-mcq/{id}', 'PrelimsController@updateMcq')->name('update-mcq');
            Route::get('delete-mcq/{id}', 'PrelimsController@deleteMcq')->name('delete-mcq');
        });
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/create-order', 'Payments\PaymentController@createOrder')->name('create-order');
    //Route::view('/payment', 'paymenttest');
    Route::get('/get-tranx-token', 'Payments\PaymentController@generatePaytmTrxToken');
});

Route::post('/validate-txn', 'Payments\PaymentController@validateTxn');
