<?php

// PARA LIMPIAR TODO PHP
// php artisan config:clear && php artisan route:clear && php artisan view:clear && php artisan config:cache && composer dump-autoload


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
