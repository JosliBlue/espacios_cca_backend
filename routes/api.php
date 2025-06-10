<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EssayController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PostEventController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SpaceReservationController;
use App\Http\Controllers\WorkshopController;
use App\Http\Middleware\IsUserAuth;
use Illuminate\Support\Facades\Route;

// Public Authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes with JWT authentication
Route::middleware([IsUserAuth::class])->group(function () {
    // Authentication
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/refresh-token', [AuthController::class, 'refresh_token']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Categories
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });

    // Locations
    Route::prefix('locations')->group(function () {
        Route::get('/', [LocationController::class, 'index']);
        Route::post('/', [LocationController::class, 'store']);
        Route::get('/{id}', [LocationController::class, 'show']);
        Route::put('/{id}', [LocationController::class, 'update']);
        Route::delete('/{id}', [LocationController::class, 'destroy']);
    });

    // Instructors
    Route::prefix('instructors')->group(function () {
        Route::get('/', [InstructorController::class, 'index']);
        Route::post('/', [InstructorController::class, 'store']);
        Route::get('/{id}', [InstructorController::class, 'show']);
        Route::put('/{id}', [InstructorController::class, 'update']);
        Route::delete('/{id}', [InstructorController::class, 'destroy']);
    });

    // Workshops
    Route::prefix('workshops')->group(function () {
        Route::get('/', [WorkshopController::class, 'index']);
        Route::post('/', [WorkshopController::class, 'store']);
        Route::get('/{id}', [WorkshopController::class, 'show']);
        Route::put('/{id}', [WorkshopController::class, 'update']);
        Route::delete('/{id}', [WorkshopController::class, 'destroy']);
        Route::post('/search', [WorkshopController::class, 'search']);
    });

    // Event Posts
    Route::prefix('post-events')->group(function () {
        Route::get('/', [PostEventController::class, 'index']);
        Route::post('/', [PostEventController::class, 'store']);
        Route::get('/{id}', [PostEventController::class, 'show']);
        Route::put('/{id}', [PostEventController::class, 'update']);
        Route::delete('/{id}', [PostEventController::class, 'destroy']);
    });

    // space reservations
    Route::prefix('space-reservations')->group(function () {
        Route::get('/', [SpaceReservationController::class, 'index']);
        Route::post('/', [SpaceReservationController::class, 'store']);
        Route::get('/{id}', [SpaceReservationController::class, 'show']);
        Route::put('/{id}', [SpaceReservationController::class, 'update']);
        Route::delete('/{id}', [SpaceReservationController::class, 'destroy']);
        Route::post('/filter-by-state', [SpaceReservationController::class, 'filterByState']);
    });

    // Essays
    Route::prefix('essays')->group(function () {
        Route::get('/', [EssayController::class, 'index']);
        Route::post('/', [EssayController::class, 'store']);
        Route::get('/{id}', [EssayController::class, 'show']);
        Route::put('/{id}', [EssayController::class, 'update']);
        Route::delete('/{id}', [EssayController::class, 'destroy']);
        Route::post('/filter-by-date', [EssayController::class, 'filterByDate']);
    });

    // Schedule Management
    Route::prefix('places')->group(function () {
        Route::get('/{placeId}/occupied', [ScheduleController::class, 'getOccupiedSchedules']);
        Route::post('/{placeId}/check-availability', [ScheduleController::class, 'checkAvailability']);
    });
});
