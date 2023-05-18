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

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::apiResource('students', StudentController::class);
});


Route::group(['prefix' => 'v2', 'namespace' => 'App\Http\Controllers\Api\V2'], function () {
    Route::apiResource('groups', GroupController::class);
    Route::apiResource('students', StudentController::class);
});
