<?php

use App\Http\Controllers\Api\V2\GroupController;
use App\Http\Controllers\Api\V2\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::post('/register', [AuthenticationController::class, 'register']);
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');
});

use App\Http\Controllers\LoginController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('oauth.callback');