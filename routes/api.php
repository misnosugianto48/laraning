<?php

use App\Http\Controllers\Api\AssignmentController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\DiscussionController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\SubmissionController;
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
            Route::get('/trash', 'indexTrash');
        });

        Route::middleware(['auth:sanctum', 'ability:lecturer'])->group(function () {
            Route::post('/', 'store');
            Route::put('/{course}', 'update');
            Route::delete('/{course}', 'destroy');
        });

        Route::middleware(['auth:sanctum', 'ability:student'])->group(function () {
            Route::get('/enroll', 'indexEnroll');
            Route::post('/{course}/enroll', 'enroll');
        });
    });

    Route::prefix('materials')->controller(MaterialController::class)->group(function () {

        Route::middleware(['auth:sanctum', 'ability:lecturer'])->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
        });

        Route::middleware(['auth:sanctum', 'ability:student'])->group(function () {
            Route::get('/{material}/download', 'download');
        });
    });

    Route::prefix('assignments')->controller(AssignmentController::class)->group(function () {

        Route::middleware(['auth:sanctum', 'ability:lecturer'])->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
        });
    });

    Route::prefix('submissions')->controller(SubmissionController::class)->group(function () {

        Route::middleware(['auth:sanctum', 'ability:student'])->group(function () {
            Route::post('/', 'store');
        });

        Route::middleware(['auth:sanctum', 'ability:lecturer'])->group(function () {
            Route::put('/{submission}/grade', 'update');
        });
    });

    Route::prefix('discussions')->controller(DiscussionController::class)->group(function () {

        Route::middleware(['auth:sanctum', 'ability:all'])->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::post('/{discussion}/replies', 'reply');
        });
    });

    Route::prefix('reports')->controller(ReportController::class)->group(function () {

        Route::middleware(['auth:sanctum', 'ability:all'])->group(function () {
            Route::get('/courses', 'courses');
            Route::get('/assignments', 'assignments');
            Route::get('/students/{student}', 'student');
        });
    });
});
