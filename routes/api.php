<?php

use App\Http\Controllers\User\CreateUserController;
use App\Http\Controllers\User\LoginUserController;
use App\Http\Controllers\User\ShowAllUserController;
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

Route::prefix('user')->group(function () {
    Route::get('/list-user', ShowAllUserController::class);
    Route::post('/register', CreateUserController::class);
    Route::post('/login', LoginUserController::class);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
