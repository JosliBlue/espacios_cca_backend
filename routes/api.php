<?php

use App\Http\Middleware\IsUserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LocalizacionController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\TallerController;
use App\Http\Controllers\PostEventoController;
use App\Http\Controllers\CasaCulturaController;
use App\Http\Controllers\EnsayoController;

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

// Autenticación pública
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con autenticación JWT
Route::middleware([IsUserAuth::class])->group(function () {
    // Autenticación
    Route::get('/perfil', [AuthController::class, 'perfil']);
    Route::post('/actualizar_token', [AuthController::class, 'actualizar_token']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Categorías
    Route::prefix('categorias')->group(function () {
        Route::get('/', [CategoriaController::class, 'index']);
        Route::post('/', [CategoriaController::class, 'store']);
        Route::get('/{id}', [CategoriaController::class, 'show']);
        Route::put('/{id}', [CategoriaController::class, 'update']);
        Route::delete('/{id}', [CategoriaController::class, 'destroy']);
    });

    // Localizaciones
    Route::prefix('localizaciones')->group(function () {
        Route::get('/', [LocalizacionController::class, 'index']);
        Route::post('/', [LocalizacionController::class, 'store']);
        Route::get('/{id}', [LocalizacionController::class, 'show']);
        Route::put('/{id}', [LocalizacionController::class, 'update']);
        Route::delete('/{id}', [LocalizacionController::class, 'destroy']);
    });

    // Instructores
    Route::prefix('instructores')->group(function () {
        Route::get('/', [InstructorController::class, 'index']);
        Route::post('/', [InstructorController::class, 'store']);
        Route::get('/{id}', [InstructorController::class, 'show']);
        Route::put('/{id}', [InstructorController::class, 'update']);
        Route::delete('/{id}', [InstructorController::class, 'destroy']);
    });

    // Talleres
    Route::prefix('talleres')->group(function () {
        Route::get('/', [TallerController::class, 'index']);
        Route::post('/', [TallerController::class, 'store']);
        Route::get('/{id}', [TallerController::class, 'show']);
        Route::put('/{id}', [TallerController::class, 'update']);
        Route::delete('/{id}', [TallerController::class, 'destroy']);
        Route::post('/buscar', [TallerController::class, 'buscar']);
    });

    // Post Eventos
    Route::prefix('post-eventos')->group(function () {
        Route::get('/', [PostEventoController::class, 'index']);
        Route::post('/', [PostEventoController::class, 'store']);
        Route::get('/{id}', [PostEventoController::class, 'show']);
        Route::put('/{id}', [PostEventoController::class, 'update']);
        Route::delete('/{id}', [PostEventoController::class, 'destroy']);
    });

    // Casas de Cultura
    Route::prefix('casas-cultura')->group(function () {
        Route::get('/', [CasaCulturaController::class, 'index']);
        Route::post('/', [CasaCulturaController::class, 'store']);
        Route::get('/{id}', [CasaCulturaController::class, 'show']);
        Route::put('/{id}', [CasaCulturaController::class, 'update']);
        Route::delete('/{id}', [CasaCulturaController::class, 'destroy']);
        Route::post('/filtrar-estado', [CasaCulturaController::class, 'filtrarPorEstado']);
    });

    // Ensayos
    Route::prefix('ensayos')->group(function () {
        Route::get('/', [EnsayoController::class, 'index']);
        Route::post('/', [EnsayoController::class, 'store']);
        Route::get('/{id}', [EnsayoController::class, 'show']);
        Route::put('/{id}', [EnsayoController::class, 'update']);
        Route::delete('/{id}', [EnsayoController::class, 'destroy']);
        Route::post('/filtrar-fecha', [EnsayoController::class, 'filtrarPorFecha']);
    });
});
