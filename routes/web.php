<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\Candidate\GetCvController;
use App\Mail\EmailVerification;
use App\Models\Candidate;
use App\Models\CompanyRepresentative;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use App\Models\User;


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

Route::get('/email-verification', function () {
    return view('email_verification');
});


Route::get('/dd', function(){
    $newUser = User::first();
    Mail::to('amalkalim@gmail.com')->send(new EmailVerification($newUser));
    return ;
 });


