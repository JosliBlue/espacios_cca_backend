<?php

use App\Http\Middleware\IsUserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\EventPostController;
use App\Http\Controllers\CulturalCenterController;
use App\Http\Controllers\RehearsalController;

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
    Route::prefix('event-posts')->group(function () {
        Route::get('/', [EventPostController::class, 'index']);
        Route::post('/', [EventPostController::class, 'store']);
        Route::get('/{id}', [EventPostController::class, 'show']);
        Route::put('/{id}', [EventPostController::class, 'update']);
        Route::delete('/{id}', [EventPostController::class, 'destroy']);
    });

    // Cultural Centers
    Route::prefix('cultural-centers')->group(function () {
        Route::get('/', [CulturalCenterController::class, 'index']);
        Route::post('/', [CulturalCenterController::class, 'store']);
        Route::get('/{id}', [CulturalCenterController::class, 'show']);
        Route::put('/{id}', [CulturalCenterController::class, 'update']);
        Route::delete('/{id}', [CulturalCenterController::class, 'destroy']);
        Route::post('/filter-by-state', [CulturalCenterController::class, 'filterByState']);
    });

    // Rehearsals
    Route::prefix('rehearsals')->group(function () {
        Route::get('/', [RehearsalController::class, 'index']);
        Route::post('/', [RehearsalController::class, 'store']);
        Route::get('/{id}', [RehearsalController::class, 'show']);
        Route::put('/{id}', [RehearsalController::class, 'update']);
        Route::delete('/{id}', [RehearsalController::class, 'destroy']);
        Route::post('/filter-by-date', [RehearsalController::class, 'filterByDate']);
    });
});
