<?php

use Illuminate\Support\Facades\Route;

Route::resource('threads', 'API\v1\Thread\ThreadController');

Route::prefix('/threads')->group(function (){
    Route::resource('answers', 'API\v1\Thread\AnswerController');

    Route::post('/{thread}/subscribe', 'API\v1\Thread\SubscribeController@subscribe')->name('subscribe');
    Route::post('/{thread}/unsubscribe', 'API\v1\Thread\SubscribeController@unSubscribe')->name('unSubscribe');
});
