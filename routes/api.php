<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;

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
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', [UserController::class, 'user']);
    Route::put('user/info', [UserController::class, 'info']);
    Route::put('user/password', [UserController::class, 'password']);
    Route::post('upload', [ImageController::class, 'upload']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('products', ProductController::class);
});
