<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::post('/register', [UserController::class, 'store']);
    Route::post('/login', [UserController::class, 'show']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/logout', [UserController::class, 'destroy']);
    });
});
