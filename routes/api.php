<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsUserAuth;
use Illuminate\Support\Facades\Route;

// PARA CREAR LA BD Y EL USUARIO ADMIN
// php artisan migrate --seed

// PARA LANZAR EL SERVIDOR
// php artisan serve

// -------------------------- http://localhost:8000/api --------------------------
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware([IsUserAuth::class])->group(function () {
    Route::get('/perfil', [AuthController::class, 'perfil']);
    Route::post('/actualizar_token', [AuthController::class, 'actualizar_token']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

