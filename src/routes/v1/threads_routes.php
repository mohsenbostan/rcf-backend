<?php

use Illuminate\Support\Facades\Route;

Route::resource('threads', 'API\v1\Thread\ThreadController');
