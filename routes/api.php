<?php

use App\Http\Controllers\Api\Candidate\CandidateController;
use App\Http\Controllers\Api\Candidate\DeletePartsCvController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Company\CompanyRepresentativeController;
use App\Http\Controllers\Api\Auth\EmailVerificationController;
use App\Http\Controllers\Api\Candidate\CvController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::get('/info', [CompanyRepresentativeController::class, 'test']);

Route::post('/candidate-register', [CandidateController::class, 'store'])->name('candidate.store');
Route::post('/company-representative-login', [CompanyRepresentativeController::class, 'login'])->name('candidate.login');
Route::post('/company-representative-register', [CompanyRepresentativeController::class, 'store']);
Route::post('/user-login1', [AuthController::class ,'login1'])->middleware('is_verified');
Route::post('/email_verification/{token}', [EmailVerificationController::class , 'verify']);





// Route::post('/create-cv-step3', [CvWorkExperienceController::class ,'store']);
// Route::post('/create-cv-step4', [CvSkillsController::class ,'store']);
/* Route::post('/store-cv', [CvController::class ,'store'])->middleware('auth:api'); */

Route::prefix('candidate')->group(function () {

    Route::middleware('auth:api')->group(function () {
     
        Route::post('/store-cv', [CvController::class ,'store']);
        Route::get('/show-cv', [CvController::class ,'show']);
        Route::post('/update-cv', [CvController::class ,'update']);
        Route::delete('/delete-cv', [CvController::class ,'destroy']);
        Route::post('/delete-degree', [DeletePartsCvController::class ,'destroyDegree']);
        Route::post('/delete-project', [DeletePartsCvController::class ,'destroyProject']);
        Route::post('/delete-competence', [DeletePartsCvController::class ,'destroyCompetence']);
        Route::post('/delete-language', [DeletePartsCvController::class ,'destroyLanguage']);
        Route::post('/delete-quality', [DeletePartsCvController::class ,'destroyQuality']);
        Route::get('/get-candidate', [CandidateController::class ,'show']);
        Route::get('/user-logout', [AuthController::class ,'logout']);

       

    });
});
Route::prefix('enterprise')->group(function () {

    Route::middleware('auth:api')->group(function () {
        Route::get('/get-categories', [CategoryController::class ,'index']);
        Route::get('/get-candidates', [CandidateController::class ,'index']);
        Route::get('/get-candidates/{category}', [CandidateController::class ,'showSpecialCandidates']);
        Route::get('/get-candidate/{token}', [CandidateController::class ,'showCandidate']);

    });

});

