<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/locations', [LocationController::class, 'index']);
Route::prefix('auth')->group(function () {
    Route::post('/signup', [UserController::class, 'store']);
    Route::post('/login', [UserController::class, 'access']);
});
