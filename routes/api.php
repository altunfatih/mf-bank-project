<?php

use App\Http\Controllers\Api\HistoryBalanceController;
use App\Http\Controllers\Api\OperationsController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResources([
        'historyBalance' => HistoryBalanceController::class,
        'users' => UserController::class
    ]);
    Route::get('/historyOfUser', [UserController::class, 'historyOfUser']);
    Route::put('/amountOperations', [OperationsController::class, 'amountOperations']);
});

Route::post('/users', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
//Route::get('/logout', [UserController::class, 'logout']);