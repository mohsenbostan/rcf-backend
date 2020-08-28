<?php


namespace App\Repositories;

use App\Answer;
use App\Subscribe;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscribeRepository
{
    public function getNotifiableUsers($thread_id)
    {
        return Subscribe::query()->where('thread_id', $thread_id)->pluck('user_id')->all();
    }
}
