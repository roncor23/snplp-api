<?php
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::post('/data', [PersonalController::class, 'store']);
    Route::get('/data', [PersonalController::class, 'index']);
    Route::post('/data/{id}', [PersonalController::class, 'update']);
    Route::get('/data/{id}', [PersonalController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/payment', [PaymentController::class, 'store']);
    Route::get('/payment/{id}', [PaymentController::class, 'per_beneficiary']);
    Route::post('/payment/{id}', [PaymentController::class, 'update']);


    Route::get('/loan', [PersonalController::class, 'get_total_loan']);
    Route::get('/interest', [PersonalController::class, 'get_total_interest']);
    Route::get('/penalty', [PersonalController::class, 'get_total_penalty']);
    Route::get('/amortization', [PersonalController::class, 'get_total_amortization']);
    Route::get('/amount_paid', [PersonalController::class, 'get_total_amount_paid']);


});


