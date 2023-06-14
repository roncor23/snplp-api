<?php
use App\Http\Controllers\PersonalController;
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

});


