<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::controller(UserController::class)->group(function () {
        Route::post('/register', 'store');
        Route::post('/login', 'show');
        Route::post('/logout', 'destroy')->middleware('auth:sanctum');
    });

    Route::prefix('courses')->controller(CourseController::class)->group(function () {
        Route::middleware(['auth:sanctum', 'ability:view'])->group(function () {
            Route::get('/', 'index');
        });

        Route::middleware(['auth:sanctum', 'ability:lecturer'])->group(function () {
            Route::post('/', 'store');
            Route::put('/{course}', 'edit');
            Route::delete('/{course}', 'destroy');
        });

        Route::middleware(['auth:sanctum', 'ability:student'])->group(function () {
            Route::post('/{course}/enroll', 'enroll');
        });
    });
});
