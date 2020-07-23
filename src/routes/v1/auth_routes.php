<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\v1\Auth\AuthController;

Route::prefix('/auth')->group(function () {
    Route::post('/register', [
        AuthController::class,
        'register'
    ])->name('auth.register');

    Route::post('/login', [
        AuthController::class,
        'login'
    ])->name('auth.login');

    Route::get('/user', [
        AuthController::class,
        'user'
    ])->name('auth.user');

    Route::post('/logout', [
        AuthController::class,
        'logout'
    ])->name('auth.logout');
});
