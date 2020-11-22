<?php

use Illuminate\Support\Facades\Route;

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

// API V1 Routes
Route::prefix('v1/')->group(function () {
    // Authentication Routes
    include __DIR__ . '/v1/auth_routes.php';

    // Authentication Routes
    include __DIR__ . '/v1/user_routes.php';

    // Channel Routes
    include __DIR__ . '/v1/channels_routes.php';

    // Thread Routes
    include __DIR__ . '/v1/threads_routes.php';
});
