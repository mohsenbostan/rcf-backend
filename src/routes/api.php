<?php

use Illuminate\Http\Request;
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

Route::prefix('v1/')->group(function () {

    // Authentication Routes
    Route::prefix('/auth')->group(function () {
        Route::post('/register', 'API\v1\Auth\AuthController@register')->name('auth.register');
        Route::post('/login', 'API\v1\Auth\AuthController@login')->name('auth.login');
        Route::get('/user', 'API\v1\Auth\AuthController@user')->name('auth.user');
        Route::post('/logout', 'API\v1\Auth\AuthController@logout')->name('auth.logout');
    });

    // Channel Route
    Route::prefix('/channel')->group(function () {
        Route::get('/all', 'API\v1\Channel\ChannelController@getAllChannelsList')->name('channel.all');
        Route::post('/create', 'API\v1\Channel\ChannelController@createNewChannel')->name('channel.create');
        Route::put('/update', 'API\v1\Channel\ChannelController@updateChannel')->name('channel.update');
        Route::delete('/delete', 'API\v1\Channel\ChannelController@deleteChannel')->name('channel.delete');
    });
});
